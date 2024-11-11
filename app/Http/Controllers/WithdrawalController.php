<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{

    public function index()
    {
        $affiliate = Auth::user()->affiliate;
        
        if ($affiliate) {
            // Ambil semua withdrawal yang dimiliki affiliate
            $withdrawals = Withdrawal::where('affiliate_id', $affiliate->id)
                ->orderBy('requested_at', 'desc')
                ->get();
            
            // Hitung total komisi yang dimiliki affiliate
            $totalCommission = Commission::where('affiliate_id', $affiliate->id)->sum('amount');
            
            // Hitung total penarikan yang sudah diajukan affiliate
            $totalWithdrawal = $withdrawals->where('status', 'approved')->sum('amount');
            $totalPending = $withdrawals->where('status', 'pending')->sum('amount');
            $totalProcessed = $withdrawals->where('status', 'approved')->sum('amount');
            
            // Sisa komisi yang bisa ditarik oleh affiliate (total komisi - penarikan yang sudah diproses)
            $remainingAmount = $totalCommission - $totalProcessed;
            
        } else {
            // Untuk Admin: Menampilkan semua withdrawals dan komisi total
            $withdrawals = Withdrawal::orderBy('requested_at', 'desc')->get();
            $totalCommission = Commission::sum('amount');
            
            // Menambahkan informasi total withdrawal, total pending, dan sisa pembayaran
            $totalWithdrawal = $withdrawals->where('status', 'approved')->sum('amount');
            $totalPending = $withdrawals->where('status', 'pending')->sum('amount');
            $totalProcessed = $withdrawals->where('status', 'approved')->sum('amount');
            $remainingAmount = $totalCommission - $totalProcessed;
        }
    
        // Return view dengan data withdrawals, total commission, dan info tambahan untuk admin
        return view('withdrawal.index', [
            'withdrawals' => $withdrawals,
            'totalCommission' => $totalCommission,
            'totalWithdrawal' => $totalWithdrawal ?? 0,
            'totalPending' => $totalPending ?? 0,
            'remainingAmount' => $remainingAmount ?? 0,
        ]);
    }
    
    
    
    public function request(Request $request)
    {
        // Validasi input
        $request->validate([
            'amount' => 'required|numeric|min:100000',  // Pastikan jumlah penarikan lebih dari 0
        ]);
    
        // Ambil affiliate yang sedang login
        $affiliate = Auth::user()->affiliate;
        
        // Hitung total komisi yang dimiliki affiliate
        $totalCommission = Commission::where('affiliate_id', $affiliate->id)->sum('amount');
        
        // Hitung total penarikan yang sudah diajukan, yang belum diproses
        $totalWithdrawn = Withdrawal::where('affiliate_id', $affiliate->id)
                                     ->whereIn('status', ['pending', 'approved']) // Penarikan yang belum ditolak
                                     ->sum('amount');
        
        $availableBalance = $totalCommission - $totalWithdrawn;
    
        // Cek apakah jumlah penarikan melebihi saldo yang tersedia
        if ($request->amount > $availableBalance) {
            return back()->withErrors(['amount' => 'Jumlah penarikan melebihi saldo komisi yang tersedia.']);
        }
    
        // Jika saldo komisi cukup, buat data penarikan baru
        Withdrawal::create([
            'affiliate_id' => $affiliate->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);
    
        // Kembalikan response dengan pesan sukses
        return back()->with('success', 'Pengajuan penarikan berhasil diajukan.');
    }
    

    public function processWithdrawal(Request $request, Withdrawal $withdrawal)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Update status dan waktu pemrosesan
        $withdrawal->status = $request->status;
        $withdrawal->processed_at = now();
        $withdrawal->save();

        // Kirim notifikasi ke affiliate jika status diubah (opsional)
        // $withdrawal->affiliate->user->notify(new WithdrawalStatusNotification($withdrawal));

        return redirect()->route('withdrawal.index')->with('success', 'Withdrawal processed successfully.');
    }

}

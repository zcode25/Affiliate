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
            $withdrawals = Withdrawal::where('affiliate_id', $affiliate->id)
                ->orderBy('requested_at', 'desc')
                ->get();
            
            $totalCommission = Commission::where('affiliate_id', $affiliate->id)->sum('amount');
            
            $totalWithdrawal = $withdrawals->where('status', 'approved')->sum('amount');
            $totalPending = $withdrawals->where('status', 'pending')->sum('amount');
            $totalProcessed = $withdrawals->where('status', 'approved')->sum('amount');
            
            $remainingAmount = $totalCommission - $totalProcessed - $totalPending;
            
        } else {
            $withdrawals = Withdrawal::orderBy('requested_at', 'desc')->get();
            $totalCommission = Commission::sum('amount');
            
            $totalWithdrawal = $withdrawals->where('status', 'approved')->sum('amount');
            $totalPending = $withdrawals->where('status', 'pending')->sum('amount');
            $totalProcessed = $withdrawals->where('status', 'approved')->sum('amount');
            $remainingAmount = $totalCommission - $totalProcessed - $totalPending;
        }
    
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
        $request->validate([
            'amount' => 'required|numeric|min:100000',
        ]);
    
        $affiliate = Auth::user()->affiliate;
        
        $totalCommission = Commission::where('affiliate_id', $affiliate->id)->sum('amount');
        
        $totalWithdrawn = Withdrawal::where('affiliate_id', $affiliate->id)
                                     ->whereIn('status', ['pending', 'approved'])
                                     ->sum('amount');
        
        $availableBalance = $totalCommission - $totalWithdrawn;
    
        if ($request->amount > $availableBalance) {
            return back()->withErrors(['amount' => 'The withdrawal amount exceeds the available commission balance']);
        }
    
        Withdrawal::create([
            'affiliate_id' => $affiliate->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);
    
        return back()->with('success', 'Withdrawal request successfully submitted');
    }
    

    public function processWithdrawal(Request $request, Withdrawal $withdrawal)
    {
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

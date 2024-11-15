<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Project;
use App\Models\Affiliate;
use App\Models\Commission;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Models\AffiliateClick;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        if(Auth::user()->role == 'Affiliate') {
            $clicksPerDay = AffiliateClick::selectRaw('DATE(created_at) as date, COUNT(*) as clicks')
                ->where('affiliate_id', Auth::user()->affiliate->id) // Filter by logged-in affiliate
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();

            $totalProjects = Project::where('affiliate_id', Auth::user()->affiliate->id)->count();
            $totalClicks = AffiliateClick::where('affiliate_id', Auth::user()->affiliate->id)->count();
            $projectStatus = Project::where('affiliate_id', Auth::user()->affiliate->id)
                            ->selectRaw('status, COUNT(*) as count')
                            ->groupBy('status')
                            ->get();
        } else {
            $clicksPerDay = AffiliateClick::selectRaw('DATE(created_at) as date, COUNT(*) as clicks')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();

            $totalProjects = Project::count();
            $totalClicks = AffiliateClick::count();
            $projectStatus = Project::selectRaw('status, COUNT(*) as count')
                            ->groupBy('status')
                            ->get();
        }
        

        return view('dashboard', [
            'totalProjects' => $totalProjects,
            'totalClicks' => $totalClicks,
            'clicksPerDay' => $clicksPerDay,
            'projectStatus' => $projectStatus,
        ]);
    }

    public function admin()
    {
        // Statistik Utama
        $totalCommissionPaid = Commission::sum('amount'); // Total komisi yang sudah dibayarkan
        $totalWithdrawal = Withdrawal::sum('amount'); // Total nilai penarikan yang diajukan
        $pendingWithdrawals = Withdrawal::where('status', 'pending')->count(); // Jumlah withdrawal yang pending
        $totalAffiliates = Affiliate::count(); // Jumlah affiliate
        $totalTransactions = Commission::count(); // Jumlah transaksi yang menghasilkan komisi
    
        // Top Affiliate berdasarkan komisi tertinggi
        $topAffiliates = Affiliate::withSum('commissions', 'amount')
            ->orderByDesc('commissions_sum_amount')
            ->take(5)
            ->get();
        
        // Statistik Performa berdasarkan waktu
        $commissionByMonth = Commission::selectRaw('SUM(amount) as total, MONTH(created_at) as month')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function($item) {
                $item->month_name = date("F", mktime(0, 0, 0, $item->month, 10));
                return $item;
            });
        
        $withdrawals = Withdrawal::orderBy('requested_at', 'desc')->get();
    
        // Statistik tambahan untuk admin
        $totalCommission = Commission::sum('amount'); // Total komisi
        $totalPendingAmount = Withdrawal::where('status', 'pending')->sum('amount'); // Total withdrawal pending
        $totalApprovedWithdrawal = Withdrawal::where('status', 'approved')->sum('amount'); // Total withdrawal yang disetujui
        $remainingAmount = $totalCommission - $totalApprovedWithdrawal; // Sisa pembayaran komisi
    
        // Notifikasi pengajuan withdrawal baru
        $recentWithdrawals = Withdrawal::where('status', 'pending')
            ->orderBy('requested_at', 'desc')
            ->take(5)
            ->get();
    
        return view('dashboardAdmin', [
            'totalCommissionPaid' => $totalCommissionPaid,
            'totalWithdrawal' => $totalWithdrawal,
            'pendingWithdrawals' => $pendingWithdrawals,
            'totalAffiliates' => $totalAffiliates,
            'totalTransactions' => $totalTransactions,
            'topAffiliates' => $topAffiliates,
            'commissionByMonth' => $commissionByMonth,
            'withdrawals' => $withdrawals,
            'totalCommission' => $totalCommission,
            'totalPendingAmount' => $totalPendingAmount,
            'totalApprovedWithdrawal' => $totalApprovedWithdrawal,
            'remainingAmount' => $remainingAmount,
            'recentWithdrawals' => $recentWithdrawals,
        ]);
    }
    

    
}

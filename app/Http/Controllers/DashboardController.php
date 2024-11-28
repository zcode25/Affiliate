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
        $affiliate = Auth::user()->affiliate;

        $totalCommission = Commission::where('affiliate_id', $affiliate->id)->sum('amount');

        $totalWithdrawal = Withdrawal::where('affiliate_id', $affiliate->id)->where('status', 'success')->sum('amount');
        $pendingWithdrawals = Withdrawal::where('affiliate_id', $affiliate->id)
            ->where('status', 'pending')
            ->sum('amount');
        $approvedWithdrawals = Withdrawal::where('affiliate_id', $affiliate->id)
            ->where('status', 'approved')
            ->sum('amount');

        $commissionByMonth = Commission::selectRaw('SUM(amount) as total, MONTH(created_at) as month')
            ->where('affiliate_id', $affiliate->id)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $item->month_name = date("F", mktime(0, 0, 0, $item->month, 10));
                return $item;
            });

        return view('dashboard', [
            'totalCommission' => $totalCommission,
            'totalWithdrawal' => $totalWithdrawal,
            'pendingWithdrawals' => $pendingWithdrawals,
            'approvedWithdrawals' => $approvedWithdrawals,
            'commissionByMonth' => $commissionByMonth,
        ]);
    }

    public function admin()
    {
        $totalCommissionPaid = Commission::sum('amount');
        $totalWithdrawal =  Withdrawal::where('status', 'approved')->sum('amount');
        $pendingWithdrawals = Withdrawal::where('status', 'pending')->count();
        $totalAffiliates = Affiliate::where('status', 'active')->count();
        $totalTransactions = Commission::count();

        $topAffiliates = Affiliate::withSum('commissions', 'amount')
            ->orderByDesc('commissions_sum_amount')
            ->take(5)
            ->get();

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
    
        $totalCommission = Commission::sum('amount'); // Total komisi
        $totalPendingAmount = Withdrawal::where('status', 'pending')->sum('amount'); // Total withdrawal pending
        $totalApprovedWithdrawal = Withdrawal::where('status', 'approved')->sum('amount'); // Total withdrawal yang disetujui
        $remainingAmount = $totalCommission - $totalApprovedWithdrawal; // Sisa pembayaran komisi
    
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

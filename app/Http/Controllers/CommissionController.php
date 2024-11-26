<?php

namespace App\Http\Controllers;


use App\Models\Commission;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
{
    public function index() {
        $affiliate = Auth::user()->affiliate;

        if (Auth::check() &&  $affiliate) {
            $withdrawals = Withdrawal::where('affiliate_id', $affiliate->id)
                ->orderBy('requested_at', 'desc')
                ->get();
            $commissions = Commission::where('affiliate_id',  $affiliate->id)
                                      ->orderBy('created_at', 'desc')
                                      ->get();
            
            $totalCommission = $commissions->sum('amount');
            $totalProcessed = $withdrawals->where('status', 'approved')->sum('amount');
            $remainingAmount = $totalCommission - $totalProcessed;
        } else {
            $withdrawals = Withdrawal::orderBy('requested_at', 'desc')->get();
            $commissions = Commission::orderBy('created_at', 'desc')->get();
            $totalCommission = $commissions->sum('amount');
            $totalProcessed = $withdrawals->where('status', 'approved')->sum('amount');
            $remainingAmount = $totalCommission - $totalProcessed;
        }

        return view('commission.index', [
            'commissions' => $commissions,
            'totalCommission' => $totalCommission,
            'remainingAmount' => $remainingAmount,
        ]);
    }
}

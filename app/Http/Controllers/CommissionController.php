<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index() {

        if (Auth::check() && Auth::user()->affiliate) {
            $commissions = Commission::where('affiliate_id', Auth::user()->affiliate->id)
                                      ->orderBy('created_at', 'desc')
                                      ->get();
            
            // Menghitung total komisi untuk affiliate yang terautentikasi
            $totalCommission = $commissions->sum('amount');
        } else {
            $commissions = Commission::orderBy('created_at', 'desc')->get();
    
            // Menghitung total komisi untuk semua affiliate
            $totalCommission = $commissions->sum('amount');
        }

        return view('commission.index', [
            'commissions' => $commissions,
            'totalCommission' => $totalCommission,
        ]);
    }
}

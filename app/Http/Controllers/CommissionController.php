<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index() {

        $commissions = Commission::orderBy('created_at', 'desc')->get();

        return view('commission.index', [
            'commissions' => $commissions
        ]);
    }
}

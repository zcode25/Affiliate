<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function registeredAffiliate() {

        $affiliates = Affiliate::where('status', 'pending')->get();
        return view('affiliate.registered', [
            'affiliates' => $affiliates
        ]);
    }

    public function activeAffiliate($id) {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->status = 'active';
        $affiliate->save();

        return redirect()->route('affiliate.registered')->with('success', 'Affiliate account successfully activated.');
    }

    public function rejectAffiliate($id) {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->status = 'reject';
        $affiliate->save();

        return redirect()->route('affiliate.registered')->with('success', 'Affiliate account has been rejected.');
    }
}

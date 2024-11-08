<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AffiliateController extends Controller
{
    public function registrationAffiliate() {
        $title = 'Registration Affiliate!';
        $text = "Are you sure?";
        confirmDelete($title, $text);

        $registrations = Affiliate::where('status', 'pending')->get();
        $registrationHistories = Affiliate::all();
        return view('affiliate.registration', [
            'registrations' => $registrations,
            'registrationHistories' => $registrationHistories
        ]);
    }

    public function activeAffiliate($id) {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->status = 'active';
        $affiliate->save();

        return redirect()->route('affiliate.registration')->with('success', 'Affiliate account successfully activated.');
    }

    public function rejectAffiliate($id) {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->status = 'reject';
        $affiliate->save();

        return redirect()->route('affiliate.registration')->with('success', 'Affiliate account has been rejected.');
    }

    public function affiliate() {
        $affiliates = Affiliate::all();
        return view('affiliate.affiliate', [
            'affiliates' => $affiliates
        ]);
    }

    public function link()
    {
        $user = Auth::user();
        $affiliateCode = $user->affiliate->affiliate_code;

        $affiliateLink = url('/landing?ref=' . $affiliateCode);

        return view('affiliate.link', [
            'affiliateLink' => $affiliateLink
        ]);
    }
}

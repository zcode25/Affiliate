<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Affiliate;
use App\Models\AffiliateClick;
use App\Models\Project;

class LandingController extends Controller
{
    public function trackAffiliateClick(Request $request)
    {
        $affiliateCode = $request->query('ref');
        $affiliate = Affiliate::where('affiliate_code', $affiliateCode)->first();
    
        if ($affiliate) {
            AffiliateClick::create([
                'affiliate_id' => $affiliate->id,
                'ip_address' => $request->ip(),
                'clicked_at' => now(),
            ]);
    
            return view('landing.index');
        } else {
            abort(403, 'Affiliate code tidak terdaftar.');
        }
    }

    public function submitProject(Request $request)
{
    $request->validate([
        'client_name' => 'required|string|max:255',
        'client_email' => 'required|email|max:255',
        'client_phone' => 'required|string|max:15',
        'project_name' => 'required|string|max:255',
        'project_type' => 'required',
        'project_description' => 'required|string',
    ]);

    // Ambil affiliate_id berdasarkan affiliate_code
    $affiliate_code = $request->input('ref');
    $affiliate = Affiliate::where('affiliate_code', $affiliate_code)->first(); // Mengambil satu data affiliate
    
    // Jika tidak ditemukan affiliate dengan kode tersebut, bisa kasih pesan error atau atur affiliate_id sebagai null
    $affiliate_id = $affiliate ? $affiliate->id : null;

    // Membuat project baru
    Project::create([
        'affiliate_id' => $affiliate_id,
        'client_name' => $request->input('client_name'),
        'client_email' => $request->input('client_email'),
        'client_phone' => $request->input('client_phone'),
        'project_name' => $request->input('project_name'),
        'project_type' => $request->input('project_type'),
        'project_description' => $request->input('project_description'),
    ]);

    // Redirect ke halaman sukses dengan notifikasi
    return redirect()->route('landing.success');
}


    public function success() {
        return view('landing.success');
    }
}

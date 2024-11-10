<?php

namespace App\Http\Controllers;

use App\Models\Project;
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
}

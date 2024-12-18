<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Affiliate;
use App\Models\Project;
use App\Models\Withdrawal;
use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\AffiliateClick;
use Illuminate\Support\Facades\Auth;
use App\Mail\AffiliateActivated;
use App\Mail\AffiliateRejected;
use App\Mail\AffiliateDeactivated;
use Illuminate\Support\Facades\Mail;

class AffiliateController extends Controller
{
    public function registrationAffiliate() {
        $title = 'Registration Affiliate!';
        $text = "Are you sure?";
        confirmDelete($title, $text);

        $registrations = Affiliate::where('status', 'pending')->orderBy('created_at', 'desc')->get();
        $registrationHistories = Affiliate::orderBy('created_at', 'desc')->get();
        return view('affiliate.registration', [
            'registrations' => $registrations,
            'registrationHistories' => $registrationHistories
        ]);
    }

    public function activeAffiliate($id) {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->status = 'active';
        $affiliate->save();

        Mail::to($affiliate->user->email)->send(new AffiliateActivated($affiliate));

        return redirect()->route('affiliate.registration')->with('success', 'Affiliate account successfully activated.');
    }

    public function rejectAffiliate($id) {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->status = 'reject';
        $affiliate->save();

        Mail::to($affiliate->user->email)->send(new AffiliateRejected($affiliate));

        return redirect()->route('affiliate.registration')->with('success', 'Affiliate account has been rejected.');
    }

    public function affiliate() {
        $totalAffiliate = Affiliate::count();
        $affiliateActive = Affiliate::where('status', 'active')->count();
        $affiliateDeactive = Affiliate::where('status', 'deactive')->count();

        $affiliates = Affiliate::all();
        return view('affiliate.affiliate', [
            'affiliates' => $affiliates,
            'totalAffiliate' => $totalAffiliate,
            'affiliateActive' => $affiliateActive,
            'affiliateDeactive' => $affiliateDeactive,
        ]);
    }

    public function detail(Affiliate $affiliate) {

        $affiliate = Affiliate::where('id', $affiliate->id)->first();

        $affiliateCode = $affiliate->affiliate_code;
        $affiliateLink = url('/landing?ref=' . $affiliateCode);
    
        $affiliateId = $affiliate->id;
    
        $affiliateClick = AffiliateClick::where('affiliate_id', $affiliateId)
            ->orderBy('clicked_at', 'desc')
            ->get();
    
        $totalClicks = $affiliateClick->count();

        $clicksThisWeek = AffiliateClick::where('affiliate_id', $affiliateId)
            ->whereBetween('clicked_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
    
        $clicksThisMonth = AffiliateClick::where('affiliate_id', $affiliateId)
            ->whereBetween('clicked_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();

        $projects = Project::where('affiliate_id', $affiliateId)->get();

        $withdrawals = Withdrawal::where('affiliate_id', $affiliateId)
                ->orderBy('requested_at', 'desc')
                ->get();
        
        $commissions = Commission::where('affiliate_id',  $affiliateId)
                ->orderBy('created_at', 'desc')
                ->get();
            
        $totalWithdrawal = $withdrawals->where('status', 'approved')->sum('amount');
        $totalCommission = $commissions->sum('amount');
        $amountCommission = $commissions->count();
        $totalProcessed = $withdrawals->where('status', 'approved')->sum('amount');
        $remainingAmount = $totalCommission - $totalProcessed;
    
        return view('affiliate.detail', [
            'affiliateLink' => $affiliateLink,
            'affiliateClick' => $affiliateClick,
            'totalClicks' => $totalClicks,
            'clicksThisWeek' => $clicksThisWeek,
            'clicksThisMonth' => $clicksThisMonth,
            'affiliate' => $affiliate,
            'projects' => $projects,
            'withdrawals' => $withdrawals,
            'commissions' => $commissions,
            'totalCommission' => $totalCommission,
            'amountCommission' => $amountCommission,
            'remainingAmount' => $remainingAmount,
            'totalWithdrawal' => $totalWithdrawal ?? 0,
        ]);

    }

    public function deactivate($id)
    {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->status = 'deactive';
        $affiliate->save();

        Mail::to($affiliate->user->email)->send(new AffiliateDeactivated($affiliate));

        return redirect()->back()->with('status', 'Affiliate successfully deactivated.');
    }

    public function activate($id)
    {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->status = 'active';
        $affiliate->save();
        
        return redirect()->back()->with('status', 'Affiliate successfully activated.');
    }

    public function link()
    {
        $user = Auth::user();
        $affiliateCode = $user->affiliate->affiliate_code;
        $affiliateLink = url('/landing?ref=' . $affiliateCode);
    
        $affiliateId = $user->affiliate->id;
    
        $affiliateClick = AffiliateClick::where('affiliate_id', $affiliateId)
            ->orderBy('clicked_at', 'desc')
            ->get();
    
        $totalClicks = $affiliateClick->count();

        $clicksThisWeek = AffiliateClick::where('affiliate_id', $affiliateId)
            ->whereBetween('clicked_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
    
        $clicksThisMonth = AffiliateClick::where('affiliate_id', $affiliateId)
            ->whereBetween('clicked_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->count();
    
        return view('affiliate.link', [
            'affiliateLink' => $affiliateLink,
            'affiliateClick' => $affiliateClick,
            'totalClicks' => $totalClicks,
            'clicksThisWeek' => $clicksThisWeek,
            'clicksThisMonth' => $clicksThisMonth,
        ]);
    }
}

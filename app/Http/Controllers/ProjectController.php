<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index(Request $request) {
        $query = Project::query();
    
        
        if (Auth::check() && Auth::user()->affiliate) {
            $query->where('affiliate_id', Auth::user()->affiliate->id);
        }
    
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('project_name', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%")
                  ->orWhere('client_email', 'like', "%{$search}%")
                  ->orWhere('client_phone', 'like', "%{$search}%");
            });
        }
    
        $projects = $query->orderBy('created_at', 'desc')->paginate(6);
    
        return view('project.index', [
            'projects' => $projects
        ]);
    }

    public function detail(Project $project) {
        return view('project.detail', [
            'project' => $project
        ]);
    }

    public function update(Request $request, Project $project)
    {
        // Validasi untuk memastikan total_value hanya diperlukan jika statusnya "deal"
        $request->validate([
            'total_value' => $request->status === 'deal' ? 'required|numeric' : 'nullable|numeric',
            'status' => 'required|string',
        ]);
    
        if ($request->status === 'cancelled') {
            $project->update([
                'status' => $request->status,
            ]);
    
        } elseif ($request->status === 'deal') {
            $project->update([
                'total_value' => $request->total_value,
                'status' => $request->status,
            ]);
    
            $commissionAmount = $project->total_value * 0.35;
    
            Commission::create([
                'affiliate_id' => $project->affiliate_id,
                'project_id' => $project->id,
                'amount' => $commissionAmount,
            ]);
        } else {
            $project->update([
                'total_value' => $request->total_value,
                'status' => $request->status,
            ]);
        }
    
        return redirect()->route('project.detail', $project)->with('success', 'Project updated successfully.');
    }

}

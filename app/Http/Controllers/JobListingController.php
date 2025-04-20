<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Category;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Job::with(['category', 'sector.district.province', 'user'])
                        ->where('is_approved', 1);

            if ($request->category_id) {
                $query->where('category_id', $request->category_id);
            }
            if ($request->sector_id) {
                $query->where('sector_id', $request->sector_id);
            }
            if ($request->search) {
                $query->where(function($q) use ($request) {
                    $q->where('title', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            }

            $jobs = $query->paginate(10);
            return response()->json([
                'jobs' => $jobs->items(),
                'pagination' => (string) $jobs->links()
            ]);
        }

        $categories = Category::all();
        $sectors = Sector::with('district.province')->get();
        return view('jobs.index', compact('categories', 'sectors'));
    }

    public function show(Job $job)
    {
        if (!$job->is_approved) {
            abort(403, 'This job is not approved.');
        }
        $job->load(['category', 'sector.district.province', 'user']);
        $hasApplied = Auth::check() ? JobApplication::where('job_id', $job->id)->where('user_id', Auth::id())->exists() : false;
        return view('jobs.show', compact('job', 'hasApplied'));
    }

    public function apply(Request $request, Job $job)
    {
        if (!$job->is_approved) {
            return response()->json(['success' => false, 'message' => 'This job is not approved.'], 403);
        }

        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Please log in to apply.'], 401);
        }

        $existingApplication = JobApplication::where('job_id', $job->id)
                                             ->where('user_id', Auth::id())
                                             ->first();
        if ($existingApplication) {
            return response()->json(['success' => false, 'message' => 'You have already applied for this job.']);
        }

        $request->validate([
            'cover_letter' => 'required|string',
        ]);

        JobApplication::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
            'cover_letter' => $request->cover_letter,
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Application submitted successfully.']);
    }
}

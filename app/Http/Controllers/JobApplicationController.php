<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Job $job)
    {
        $user = auth()->user();

        // Check if the user has already applied
        $existingApplication = JobApplication::where('user_id', $user->id)
                                            ->where('job_id', $job->id)
                                            ->exists();

        if ($existingApplication) {
            return redirect()->route('dashboard')->with('error', 'You have already applied for this job.');
        }

        JobApplication::create([
            'user_id' => $user->id,
            'job_id' => $job->id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Application submitted successfully.');
    }
}

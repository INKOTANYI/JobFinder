<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_jobs' => Job::count(),
            'total_users' => User::count(),
            'total_applications' => JobApplication::count(),
            'pending_applications' => JobApplication::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function getJobs()
    {
        $jobs = Job::all();
        return view('admin.jobs', compact('jobs'));
    }

    public function getUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function getApplications()
    {
        $applications = JobApplication::all();
        return view('admin.applications', compact('applications'));
    }

    public function getPendingApplications()
    {
        $applications = JobApplication::where('status', 'pending')->get();
        return view('admin.applications', compact('applications'));
    }
}

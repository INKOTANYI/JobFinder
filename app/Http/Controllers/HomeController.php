<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [];

        if ($user->role === 'admin') {
            $stats['total_jobs'] = Job::count();
            $stats['total_users'] = User::count();
            $stats['total_applications'] = JobApplication::count();
            $stats['pending_applications'] = JobApplication::where('status', 'pending')->count();
        }

        return view('dashboard', compact('user', 'stats'));
    }
}

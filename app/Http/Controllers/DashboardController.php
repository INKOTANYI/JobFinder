<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jobs = Job::where('is_approved', true)->get();
        return view('dashboard', compact('jobs'));
    }
}

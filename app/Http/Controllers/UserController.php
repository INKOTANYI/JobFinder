<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $jobs = Job::latest()->take(10)->get();
        return view('user.dashboard', compact('jobs'));
    }
}

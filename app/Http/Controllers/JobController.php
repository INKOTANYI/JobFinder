<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::where('is_approved', true)->get();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('jobs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:Full Time,Part Time',
            'deadline' => 'nullable|date',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'nullable|boolean',
        ]);

        $job = auth()->user()->jobs()->create([
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'type' => $request->type,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'is_featured' => $request->is_featured ?? false,
            'is_approved' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Job posted successfully! Awaiting admin approval.');
    }

    public function apply($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in or register to apply for this job.');
        }

        $job = Job::findOrFail($id);
        // Simulate job application (in a real app, you'd save the application to a database)
        return redirect()->route('jobs.index')->with('success', 'You have successfully applied for the job: ' . $job->title);
    }
}

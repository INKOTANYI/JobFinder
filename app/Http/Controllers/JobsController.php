<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Request;

class JobsController extends Controller
{
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
            'deadline' => 'required|date|after:today',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'nullable|boolean',
        ]);

        Job::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'type' => $request->type,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('jobs.create')->with('success', 'Job posted successfully!');
    }
}

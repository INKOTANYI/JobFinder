<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\Category;
use App\Models\Sector;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $jobs = Job::with(['category', 'sector.district.province', 'department', 'user'])->get();
            return response()->json([
                'jobs' => $jobs
            ]);
        }
        return view('admin.jobs.index');
    }

    public function create()
    {
        $categories = Category::all();
        $sectors = Sector::with('district.province')->get();
        $departments = Department::all();
        return response()->json([
            'categories' => $categories,
            'sectors' => $sectors,
            'departments' => $departments
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'type' => 'required|in:Full Time,Part Time',
            'deadline' => 'required|date|after:today',
            'category_id' => 'required|exists:categories,id',
            'sector_id' => 'required|exists:sectors,id',
            'department_id' => 'required|exists:departments,id',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $job = Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'salary' => $request->salary,
            'type' => $request->type,
            'deadline' => $request->deadline,
            'category_id' => $request->category_id,
            'sector_id' => $request->sector_id,
            'department_id' => $request->department_id,
            'user_id' => Auth::id(),
            'is_approved' => $request->is_approved ?? 0,
            'is_featured' => $request->is_featured ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Job created successfully.',
            'job' => $job->load(['category', 'sector.district.province', 'department', 'user'])
        ]);
    }

    public function show(Job $job)
    {
        $job->load(['category', 'sector.district.province', 'department', 'user']);
        return view('admin.jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        $job->load(['category', 'sector.district.province', 'department', 'user']);
        return response()->json($job);
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'salary' => 'required|numeric|min:0',
            'type' => 'required|in:Full Time,Part Time',
            'deadline' => 'required|date|after:today',
            'category_id' => 'required|exists:categories,id',
            'sector_id' => 'required|exists:sectors,id',
            'department_id' => 'required|exists:departments,id',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'salary' => $request->salary,
            'type' => $request->type,
            'deadline' => $request->deadline,
            'category_id' => $request->category_id,
            'sector_id' => $request->sector_id,
            'department_id' => $request->department_id,
            'is_approved' => $request->is_approved ?? 0,
            'is_featured' => $request->is_featured ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Job updated successfully.',
            'job' => $job->load(['category', 'sector.district.province', 'department', 'user'])
        ]);
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return response()->json([
            'success' => true,
            'message' => 'Job deleted successfully.'
        ]);
    }
}

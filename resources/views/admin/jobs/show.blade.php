@extends('layouts.app')

@section('title', 'View Job')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Job Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Title:</strong> {{ $job->title }}</p>
            <p><strong>Description:</strong> {{ $job->description }}</p>
            <p><strong>Requirements:</strong> {{ $job->requirements }}</p>
            <p><strong>Salary:</strong> {{ number_format($job->salary, 2) }}</p>
            <p><strong>Type:</strong> {{ $job->type }}</p>
            <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') }}</p>
            <p><strong>Category:</strong> {{ $job->category->name ?? 'N/A' }}</p>
            <p><strong>Sector:</strong> {{ $job->sector->name ?? 'N/A' }} ({{ $job->sector->district->name ?? 'N/A' }}, {{ $job->sector->district->province->name ?? 'N/A' }})</p>
            <p><strong>Department:</strong> {{ $job->department->name ?? 'N/A' }}</p>
            <p><strong>Created By:</strong> {{ $job->user->name ?? 'N/A' }}</p>
            <p><strong>Approved:</strong> {{ $job->is_approved ? 'Yes' : 'No' }}</p>
            <p><strong>Featured:</strong> {{ $job->is_featured ? 'Yes' : 'No' }}</p>
            <a href="{{ route('admin.jobs.index') }}" class="btn btn-primary">Back to Jobs</a>
        </div>
    </div>
@endsection

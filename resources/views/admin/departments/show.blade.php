@extends('layouts.app')

@section('title', 'View Department')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Department Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $department->name }}</p>
            <a href="{{ route('admin.departments.index') }}" class="btn btn-primary">Back to Departments</a>
        </div>
    </div>
@endsection

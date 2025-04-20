@extends('layouts.app')

@section('title', 'View District')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">District Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $district->name }}</p>
            <p><strong>Province:</strong> {{ $district->province->name ?? 'N/A' }}</p>
            <a href="{{ route('admin.districts.index') }}" class="btn btn-primary">Back to Districts</a>
        </div>
    </div>
@endsection

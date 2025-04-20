@extends('layouts.app')

@section('title', 'View Sector')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sector Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $sector->name }}</p>
            <p><strong>District:</strong> {{ $sector->district->name ?? 'N/A' }}</p>
            <p><strong>Province:</strong> {{ $sector->district->province->name ?? 'N/A' }}</p>
            <a href="{{ route('admin.sectors.index') }}" class="btn btn-primary">Back to Sectors</a>
        </div>
    </div>
@endsection

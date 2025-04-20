@extends('layouts.app')

@section('title', 'View Province')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Province Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $province->name }}</p>
            <a href="{{ route('admin.provinces.index') }}" class="btn btn-primary">Back to Provinces</a>
        </div>
    </div>
@endsection

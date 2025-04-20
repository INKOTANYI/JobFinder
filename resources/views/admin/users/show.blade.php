@extends('layouts.app')

@section('title', 'View User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
            <p><strong>Created At:</strong> {{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d H:i:s') }}</p>
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Back to Users</a>
        </div>
    </div>
@endsection

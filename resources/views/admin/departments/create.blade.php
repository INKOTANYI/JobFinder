@extends('layouts.admin')

@section('title', 'Create Department')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create a New Department</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.departments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Department</button>
        </form>
    </div>
</div>
@endsection
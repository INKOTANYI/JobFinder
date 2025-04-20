@extends('layouts.admin')

@section('title', 'Create Province')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create a New Province</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.provinces.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Province Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Province</button>
        </form>
    </div>
</div>
@endsection
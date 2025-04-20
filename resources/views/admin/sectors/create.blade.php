@extends('layouts.admin')

@section('title', 'Create Sector')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create a New Sector</h3>
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

        <form action="{{ route('admin.sectors.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="district_id">District</label>
                <select name="district_id" id="district_id" class="form-control @error('district_id') is-invalid @enderror" required>
                    <option value="">Select a district</option>
                    @foreach ($districts as $district)
                        <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                    @endforeach
                </select>
                @error('district_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Sector Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create Sector</button>
        </form>
    </div>
</div>
@endsection
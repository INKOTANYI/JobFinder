@extends('layouts.admin')

@section('title', 'Create District')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create a New District</h3>
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

        <form action="{{ route('admin.districts.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="province_id">Province</label>
                <select name="province_id" id="province_id" class="form-control @error('province_id') is-invalid @enderror" required>
                    <option value="">Select a province</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                    @endforeach
                </select>
                @error('province_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">District Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create District</button>
        </form>
    </div>
</div>
@endsection
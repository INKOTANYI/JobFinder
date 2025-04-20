@extends('layouts.app')

@section('title', 'Edit Sector')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Sector</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sectors.update', $sector) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Sector Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $sector->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="district_id">District <span class="text-danger">*</span></label>
                    <select name="district_id" id="district_id" class="form-control @error('district_id') is-invalid @enderror">
                        <option value="">Select District</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ old('district_id', $sector->district_id) == $district->id ? 'selected' : '' }}>{{ $district->name }} ({{ $district->province->name ?? 'N/A' }})</option>
                        @endforeach
                    </select>
                    @error('district_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Sector</button>
            </form>
        </div>
    </div>
@endsection

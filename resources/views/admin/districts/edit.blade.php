@extends('layouts.app')

@section('title', 'Edit District')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit District</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.districts.update', $district) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">District Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $district->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="province_id">Province <span class="text-danger">*</span></label>
                    <select name="province_id" id="province_id" class="form-control @error('province_id') is-invalid @enderror">
                        <option value="">Select Province</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" {{ old('province_id', $district->province_id) == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                        @endforeach
                    </select>
                    @error('province_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update District</button>
            </form>
        </div>
    </div>
@endsection

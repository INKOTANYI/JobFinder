@extends('layouts.app')

@section('title', 'Edit Province')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Province</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.provinces.update', $province) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Province Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $province->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Province</button>
            </form>
        </div>
    </div>
@endsection

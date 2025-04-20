@extends('layouts.app')

@section('title', 'Edit Department')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Department</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.departments.update', $department) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Department Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $department->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Department</button>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Create Job')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create New Job</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.jobs.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Job Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="requirements">Requirements <span class="text-danger">*</span></label>
                    <textarea name="requirements" id="requirements" class="form-control @error('requirements') is-invalid @enderror" rows="3">{{ old('requirements') }}</textarea>
                    @error('requirements')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="salary">Salary <span class="text-danger">*</span></label>
                    <input type="number" name="salary" id="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary') }}" step="0.01">
                    @error('salary')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="type">Type <span class="text-danger">*</span></label>
                    <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                        <option value="Full Time" {{ old('type') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                        <option value="Part Time" {{ old('type') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline <span class="text-danger">*</span></label>
                    <input type="date" name="deadline" id="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline') }}">
                    @error('deadline')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category_id">Category <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sector_id">Sector <span class="text-danger">*</span></label>
                    <select name="sector_id" id="sector_id" class="form-control @error('sector_id') is-invalid @enderror">
                        <option value="">Select Sector</option>
                        @foreach ($sectors as $sector)
                            <option value="{{ $sector->id }}" {{ old('sector_id') == $sector->id ? 'selected' : '' }}>{{ $sector->name }} ({{ $sector->district->name ?? 'N/A' }}, {{ $sector->district->province->name ?? 'N/A' }})</option>
                        @endforeach
                    </select>
                    @error('sector_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="department_id">Department <span class="text-danger">*</span></label>
                    <select name="department_id" id="department_id" class="form-control @error('department_id') is-invalid @enderror">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="is_approved" id="is_approved" class="form-check-input" value="1" {{ old('is_approved') ? 'checked' : '' }}>
                        <label for="is_approved" class="form-check-label">Approved</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label for="is_featured" class="form-check-label">Featured</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Job</button>
            </form>
        </div>
    </div>
@endsection

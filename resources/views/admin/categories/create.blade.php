@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create New Category</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create Category</button>
            </form>
        </div>
    </div>
@endsection

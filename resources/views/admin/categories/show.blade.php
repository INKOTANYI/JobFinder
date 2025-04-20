@extends('layouts.app')

@section('title', 'View Category')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Category Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $category->name }}</p>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Back to Categories</a>
        </div>
    </div>
@endsection
EOFcat << 'EOF' > resources/views/admin/categories/show.blade.php
@extends('layouts.app')

@section('title', 'View Category')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Category Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $category->name }}</p>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Back to Categories</a>
        </div>
    </div>
@endsection

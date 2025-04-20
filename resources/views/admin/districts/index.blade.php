@extends('layouts.app')

@section('title', 'Districts')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Districts</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createDistrictModal">
                    <i class="fas fa-plus"></i> Add District
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Province</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($districts as $index => $district)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $district->name }}</td>
                            <td>{{ $district->province->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.districts.show', $district) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editDistrictModal{{ $district->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.districts.destroy', $district) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this district?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit District Modal -->
                        <div class="modal fade" id="editDistrictModal{{ $district->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit District</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.districts.update', $district) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
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
                                                    @foreach (\App\Models\Province::all() as $province)
                                                        <option value="{{ $province->id }}" {{ old('province_id', $district->province_id) == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('province_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update District</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No districts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create District Modal -->
    <div class="modal fade" id="createDistrictModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New District</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('admin.districts.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">District Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="province_id">Province <span class="text-danger">*</span></label>
                            <select name="province_id" id="province_id" class="form-control @error('province_id') is-invalid @enderror">
                                <option value="">Select Province</option>
                                @foreach (\App\Models\Province::all() as $province)
                                    <option value="{{ $province->id }}" {{ old('province_id') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                @endforeach
                            </select>
                            @error('province_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create District</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

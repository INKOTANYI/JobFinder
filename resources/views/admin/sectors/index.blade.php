@extends('layouts.app')

@section('title', 'Sectors')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sectors</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createSectorModal">
                    <i class="fas fa-plus"></i> Add Sector
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
                        <th>District</th>
                        <th>Province</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sectors as $index => $sector)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sector->name }}</td>
                            <td>{{ $sector->district->name ?? 'N/A' }}</td>
                            <td>{{ $sector->district->province->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.sectors.show', $sector) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editSectorModal{{ $sector->id }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form action="{{ route('admin.sectors.destroy', $sector) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sector?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Sector Modal -->
                        <div class="modal fade" id="editSectorModal{{ $sector->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Sector</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.sectors.update', $sector) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Sector Name <span class="text-danger">*</ g>
                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $sector->name) }}">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="district_id">District <span class="text-danger">*</span></label>
                                                <select name="district_id" id="district_id" class="form-control @error('district_id') is-invalid @enderror">
                                                    <option value="">Select District</option>
                                                    @foreach (\App\Models\District::with('province')->get() as $district)
                                                        <option value="{{ $district->id }}" {{ old('district_id', $sector->district_id) == $district->id ? 'selected' : '' }}>{{ $district->name }} ({{ $district->province->name ?? 'N/A' }})</option>
                                                    @endforeach
                                                </select>
                                                @error('district_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update Sector</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No sectors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Sector Modal -->
    <div class="modal fade" id="createSectorModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Sector</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('admin.sectors.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Sector Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="district_id">District <span class="text-danger">*</span></label>
                            <select name="district_id" id="district_id" class="form-control @error('district_id') is-invalid @enderror">
                                <option value="">Select District</option>
                                @foreach (\App\Models\District::with('province')->get() as $district)
                                    <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>{{ $district->name }} ({{ $district->province->name ?? 'N/A' }})</option>
                                @endforeach
                            </select>
                            @error('district_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Sector</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

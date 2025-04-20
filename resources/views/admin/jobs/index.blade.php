@extends('layouts.app')

@section('title', 'Jobs')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Jobs</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createJobModal">
                    <i class="fas fa-plus"></i> Add Job
                </button>
            </div>
        </div>
        <div class="card-body">
            <div id="alert-container"></div>
            <table id="jobs-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Sector</th>
                        <th>Department</th>
                        <th>Type</th>
                        <th>Salary</th>
                        <th>Deadline</th>
                        <th>Approved</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows will be populated via AJAX -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Job Modal -->
    <div class="modal fade" id="createJobModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="create-job-form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Job Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="create-title" class="form-control">
                            <span class="text-danger" id="create-title-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="create-description" class="form-control" rows="3"></textarea>
                            <span class="text-danger" id="create-description-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="requirements">Requirements <span class="text-danger">*</span></label>
                            <textarea name="requirements" id="create-requirements" class="form-control" rows="3"></textarea>
                            <span class="text-danger" id="create-requirements-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="salary">Salary <span class="text-danger">*</span></label>
                            <input type="number" name="salary" id="create-salary" class="form-control" step="0.01">
                            <span class="text-danger" id="create-salary-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="type">Type <span class="text-danger">*</span></label>
                            <select name="type" id="create-type" class="form-control">
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                            </select>
                            <span class="text-danger" id="create-type-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="deadline">Deadline <span class="text-danger">*</span></label>
                            <input type="date" name="deadline" id="create-deadline" class="form-control">
                            <span class="text-danger" id="create-deadline-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="create-category_id" class="form-control"></select>
                            <span class="text-danger" id="create-category_id-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="sector_id">Sector <span class="text-danger">*</span></label>
                            <select name="sector_id" id="create-sector_id" class="form-control"></select>
                            <span class="text-danger" id="create-sector_id-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="department_id">Department <span class="text-danger">*</span></label>
                            <select name="department_id" id="create-department_id" class="form-control"></select>
                            <span class="text-danger" id="create-department_id-error"></span>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" name="is_approved" id="create-is_approved" class="form-check-input" value="1">
                                <label for="create-is_approved" class="form-check-label">Approved</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" name="is_featured" id="create-is_featured" class="form-check-input" value="1">
                                <label for="create-is_featured" class="form-check-label">Featured</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Job</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Job Modal -->
    <div class="modal fade" id="editJobModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="edit-job-form">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-job-id">
                        <div class="form-group">
                            <label for="title">Job Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="edit-title" class="form-control">
                            <span class="text-danger" id="edit-title-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="edit-description" class="form-control" rows="3"></textarea>
                            <span class="text-danger" id="edit-description-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="requirements">Requirements <span class="text-danger">*</span></label>
                            <textarea name="requirements" id="edit-requirements" class="form-control" rows="3"></textarea>
                            <span class="text-danger" id="edit-requirements-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="salary">Salary <span class="text-danger">*</span></label>
                            <input type="number" name="salary" id="edit-salary" class="form-control" step="0.01">
                            <span class="text-danger" id="edit-salary-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="type">Type <span class="text-danger">*</span></label>
                            <select name="type" id="edit-type" class="form-control">
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                            </select>
                            <span class="text-danger" id="edit-type-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="deadline">Deadline <span class="text-danger">*</span></label>
                            <input type="date" name="deadline" id="edit-deadline" class="form-control">
                            <span class="text-danger" id="edit-deadline-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="edit-category_id" class="form-control"></select>
                            <span class="text-danger" id="edit-category_id-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="sector_id">Sector <span class="text-danger">*</span></label>
                            <select name="sector_id" id="edit-sector_id" class="form-control"></select>
                            <span class="text-danger" id="edit-sector_id-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="department_id">Department <span class="text-danger">*</span></label>
                            <select name="department_id" id="edit-department_id" class="form-control"></select>
                            <span class="text-danger" id="edit-department_id-error"></span>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" name="is_approved" id="edit-is_approved" class="form-check-input" value="1">
                                <label for="edit-is_approved" class="form-check-label">Approved</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" name="is_featured" id="edit-is_featured" class="form-check-input" value="1">
                                <label for="edit-is_featured" class="form-check-label">Featured</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Job</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                // Load jobs via AJAX
                function loadJobs() {
                    $.ajax({
                        url: '{{ route("admin.jobs.index") }}',
                        method: 'GET',
                        success: function(response) {
                            let tbody = $('#jobs-table tbody');
                            tbody.empty();
                            response.jobs.forEach((job, index) => {
                                let row = `
                                    <tr data-id="${job.id}">
                                        <td>${index + 1}</td>
                                        <td>${job.title}</td>
                                        <td>${job.category?.name ?? 'N/A'}</td>
                                        <td>${job.sector?.name ?? 'N/A'} (${job.sector?.district?.name ?? 'N/A'}, ${job.sector?.district?.province?.name ?? 'N/A'})</td>
                                        <td>${job.department?.name ?? 'N/A'}</td>
                                        <td>${job.type}</td>
                                        <td>${parseFloat(job.salary).toFixed(2)}</td>
                                        <td>${new Date(job.deadline).toISOString().split('T')[0]}</td>
                                        <td>${job.is_approved ? 'Yes' : 'No'}</td>
                                        <td>${job.is_featured ? 'Yes' : 'No'}</td>
                                        <td>
                                            <a href="{{ url('admin/jobs') }}/${job.id}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <button type="button" class="btn btn-warning btn-sm edit-job-btn" data-id="${job.id}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-job-btn" data-id="${job.id}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>`;
                                tbody.append(row);
                            });
                        },
                        error: function() {
                            showAlert('danger', 'Failed to load jobs.');
                        }
                    });
                }

                // Load dropdowns for create modal
                $('#createJobModal').on('show.bs.modal', function() {
                    $.ajax({
                        url: '{{ route("admin.jobs.create") }}',
                        method: 'GET',
                        success: function(response) {
                            // Populate categories
                            let categorySelect = $('#create-category_id');
                            categorySelect.empty();
                            categorySelect.append('<option value="">Select Category</option>');
                            response.categories.forEach(category => {
                                categorySelect.append(`<option value="${category.id}">${category.name}</option>`);
                            });

                            // Populate sectors
                            let sectorSelect = $('#create-sector_id');
                            sectorSelect.empty();
                            sectorSelect.append('<option value="">Select Sector</option>');
                            response.sectors.forEach(sector => {
                                sectorSelect.append(`<option value="${sector.id}">${sector.name} (${sector.district?.name ?? 'N/A'}, ${sector.district?.province?.name ?? 'N/A'})</option>`);
                            });

                            // Populate departments
                            let departmentSelect = $('#create-department_id');
                            departmentSelect.empty();
                            departmentSelect.append('<option value="">Select Department</option>');
                            response.departments.forEach(department => {
                                departmentSelect.append(`<option value="${department.id}">${department.name}</option>`);
                            });
                        },
                        error: function() {
                            showAlert('danger', 'Failed to load dropdown data.');
                        }
                    });
                });

                // Handle create form submission
                $('#create-job-form').on('submit', function(e) {
                    e.preventDefault();
                    let data = {
                        title: $('#create-title').val(),
                        description: $('#create-description').val(),
                        requirements: $('#create-requirements').val(),
                        salary: $('#create-salary').val(),
                        type: $('#create-type').val(),
                        deadline: $('#create-deadline').val(),
                        category_id: $('#create-category_id').val(),
                        sector_id: $('#create-sector_id').val(),
                        department_id: $('#create-department_id').val(),
                        is_approved: $('#create-is_approved').is(':checked') ? 1 : 0,
                        is_featured: $('#create-is_featured').is(':checked') ? 1 : 0,
                        _token: '{{ csrf_token() }}'
                    };

                    // Clear previous errors
                    $('#create-job-form .text-danger').text('');

                    $.ajax({
                        url: '{{ route("admin.jobs.store") }}',
                        method: 'POST',
                        data: data,
                        success: function(response) {
                            $('#createJobModal').modal('hide');
                            showAlert('success', response.message);
                            loadJobs();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                for (let field in errors) {
                                    $(`#create-${field}-error`).text(errors[field][0]);
                                }
                            } else {
                                showAlert('danger', 'Failed to create job.');
                            }
                        }
                    });
                });

                // Load dropdowns for edit modal and populate data
                $(document).on('click', '.edit-job-btn', function() {
                    let jobId = $(this).data('id');
                    $.ajax({
                        url: '{{ url("admin/jobs") }}/' + jobId + '/edit',
                        method: 'GET',
                        success: function(job) {
                            $('#edit-job-id').val(job.id);
                            $('#edit-title').val(job.title);
                            $('#edit-description').val(job.description);
                            $('#edit-requirements').val(job.requirements);
                            $('#edit-salary').val(job.salary);
                            $('#edit-type').val(job.type);
                            $('#edit-deadline').val(new Date(job.deadline).toISOString().split('T')[0]);
                            $('#edit-is_approved').prop('checked', job.is_approved);
                            $('#edit-is_featured').prop('checked', job.is_featured);

                            // Populate categories
                            let categorySelect = $('#edit-category_id');
                            categorySelect.empty();
                            categorySelect.append('<option value="">Select Category</option>');
                            $.ajax({
                                url: '{{ route("admin.jobs.create") }}',
                                method: 'GET',
                                success: function(response) {
                                    response.categories.forEach(category => {
                                        let selected = category.id == job.category_id ? 'selected' : '';
                                        categorySelect.append(`<option value="${category.id}" ${selected}>${category.name}</option>`);
                                    });

                                    // Populate sectors
                                    let sectorSelect = $('#edit-sector_id');
                                    sectorSelect.empty();
                                    sectorSelect.append('<option value="">Select Sector</option>');
                                    response.sectors.forEach(sector => {
                                        let selected = sector.id == job.sector_id ? 'selected' : '';
                                        sectorSelect.append(`<option value="${sector.id}" ${selected}>${sector.name} (${sector.district?.name ?? 'N/A'}, ${sector.district?.province?.name ?? 'N/A'})</option>`);
                                    });

                                    // Populate departments
                                    let departmentSelect = $('#edit-department_id');
                                    departmentSelect.empty();
                                    departmentSelect.append('<option value="">Select Department</option>');
                                    response.departments.forEach(department => {
                                        let selected = department.id == job.department_id ? 'selected' : '';
                                        departmentSelect.append(`<option value="${department.id}" ${selected}>${department.name}</option>`);
                                    });

                                    $('#editJobModal').modal('show');
                                }
                            });
                        },
                        error: function() {
                            showAlert('danger', 'Failed to load job data.');
                        }
                    });
                });

                // Handle edit form submission
                $('#edit-job-form').on('submit', function(e) {
                    e.preventDefault();
                    let jobId = $('#edit-job-id').val();
                    let data = {
                        title: $('#edit-title').val(),
                        description: $('#edit-description').val(),
                        requirements: $('#edit-requirements').val(),
                        salary: $('#edit-salary').val(),
                        type: $('#edit-type').val(),
                        deadline: $('#edit-deadline').val(),
                        category_id: $('#edit-category_id').val(),
                        sector_id: $('#edit-sector_id').val(),
                        department_id: $('#edit-department_id').val(),
                        is_approved: $('#edit-is_approved').is(':checked') ? 1 : 0,
                        is_featured: $('#edit-is_featured').is(':checked') ? 1 : 0,
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT'
                    };

                    // Clear previous errors
                    $('#edit-job-form .text-danger').text('');

                    $.ajax({
                        url: '{{ url("admin/jobs") }}/' + jobId,
                        method: 'POST',
                        data: data,
                        success: function(response) {
                            $('#editJobModal').modal('hide');
                            showAlert('success', response.message);
                            loadJobs();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                for (let field in errors) {
                                    $(`#edit-${field}-error`).text(errors[field][0]);
                                }
                            } else {
                                showAlert('danger', 'Failed to update job.');
                            }
                        }
                    });
                });

                // Handle delete
                $(document).on('click', '.delete-job-btn', function() {
                    if (!confirm('Are you sure you want to delete this job?')) {
                        return;
                    }
                    let jobId = $(this).data('id');
                    $.ajax({
                        url: '{{ url("admin/jobs") }}/' + jobId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            showAlert('success', response.message);
                            loadJobs();
                        },
                        error: function() {
                            showAlert('danger', 'Failed to delete job.');
                        }
                    });
                });

                // Function to show alerts
                function showAlert(type, message) {
                    let alert = `
                        <div class="alert alert-${type} alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            ${message}
                        </div>`;
                    $('#alert-container').html(alert);
                }

                // Initial load
                loadJobs();
            });
        </script>
    @endsection
@endsection

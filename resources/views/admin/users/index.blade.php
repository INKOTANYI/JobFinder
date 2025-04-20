@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Users</h3>
        </div>
        <div class="card-body">
            <div id="alert-container"></div>
            <table id="users-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Table rows will be populated via AJAX -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="edit-user-form">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-user-id">
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="edit-name" class="form-control">
                            <span class="text-danger" id="edit-name-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="edit-email" class="form-control">
                            <span class="text-danger" id="edit-email-error"></span>
                        </div>
                        <div class="form-group">
                            <label for="role">Role <span class="text-danger">*</span></label>
                            <select name="role" id="edit-role" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                            <span class="text-danger" id="edit-role-error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                // Load users via AJAX
                function loadUsers() {
                    $.ajax({
                        url: '{{ route("admin.users.index") }}',
                        method: 'GET',
                        success: function(response) {
                            let tbody = $('#users-table tbody');
                            tbody.empty();
                            response.users.forEach((user, index) => {
                                let row = `
                                    <tr data-id="${user.id}">
                                        <td>${index + 1}</td>
                                        <td>${user.name}</td>
                                        <td>${user.email}</td>
                                        <td>${user.role.charAt(0).toUpperCase() + user.role.slice(1)}</td>
                                        <td>
                                            <a href="{{ url('admin/users') }}/${user.id}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <button type="button" class="btn btn-warning btn-sm edit-user-btn" data-id="${user.id}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-user-btn" data-id="${user.id}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>`;
                                tbody.append(row);
                            });
                        },
                        error: function() {
                            showAlert('danger', 'Failed to load users.');
                        }
                    });
                }

                // Initial load
                loadUsers();

                // Show edit modal and populate data
                $(document).on('click', '.edit-user-btn', function() {
                    let userId = $(this).data('id');
                    $.ajax({
                        url: '{{ url("admin/users") }}/' + userId + '/edit',
                        method: 'GET',
                        success: function(user) {
                            $('#edit-user-id').val(user.id);
                            $('#edit-name').val(user.name);
                            $('#edit-email').val(user.email);
                            $('#edit-role').val(user.role);
                            $('#editUserModal').modal('show');
                        },
                        error: function() {
                            showAlert('danger', 'Failed to load user data.');
                        }
                    });
                });

                // Handle edit form submission
                $('#edit-user-form').on('submit', function(e) {
                    e.preventDefault();
                    let userId = $('#edit-user-id').val();
                    let data = {
                        name: $('#edit-name').val(),
                        email: $('#edit-email').val(),
                        role: $('#edit-role').val(),
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT'
                    };

                    // Clear previous errors
                    $('#edit-name-error').text('');
                    $('#edit-email-error').text('');
                    $('#edit-role-error').text('');

                    $.ajax({
                        url: '{{ url("admin/users") }}/' + userId,
                        method: 'POST',
                        data: data,
                        success: function(response) {
                            $('#editUserModal').modal('hide');
                            showAlert('success', response.message);
                            loadUsers(); // Refresh the table
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                if (errors.name) $('#edit-name-error').text(errors.name[0]);
                                if (errors.email) $('#edit-email-error').text(errors.email[0]);
                                if (errors.role) $('#edit-role-error').text(errors.role[0]);
                            } else {
                                showAlert('danger', 'Failed to update user.');
                            }
                        }
                    });
                });

                // Handle delete
                $(document).on('click', '.delete-user-btn', function() {
                    if (!confirm('Are you sure you want to delete this user?')) {
                        return;
                    }
                    let userId = $(this).data('id');
                    $.ajax({
                        url: '{{ url("admin/users") }}/' + userId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            showAlert('success', response.message);
                            loadUsers(); // Refresh the table
                        },
                        error: function(xhr) {
                            showAlert('danger', xhr.responseJSON.message || 'Failed to delete user.');
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
            });
        </script>
    @endsection
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Profile - Ishakiro Job Solution</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .required::before {
            content: '*';
            color: red;
            margin-right: 5px;
        }
    </style>
</head>
<body class="hold-transition">
    <div class="container mt-5">
        <!-- Modal -->
        <div class="modal fade show" id="completeProfileModal" tabindex="-1" aria-labelledby="completeProfileModalLabel" aria-hidden="true" style="display: block;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="completeProfileModalLabel">Complete Your Profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label required">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label required">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="background" class="form-label required">Background</label>
                                        <input type="text" class="form-control @error('background') is-invalid @enderror" id="background" name="background" value="{{ old('background') }}">
                                        @error('background')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="experience_years" class="form-label required">Experience Years</label>
                                        <input type="number" class="form-control @error('experience_years') is-invalid @enderror" id="experience_years" name="experience_years" value="{{ old('experience_years') }}" min="0">
                                        @error('experience_years')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="province_id" class="form-label required">Province</label>
                                        <select class="form-control @error('province_id') is-invalid @enderror" id="province_id" name="province_id">
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
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="district_id" class="form-label required">District</label>
                                        <select class="form-control @error('district_id') is-invalid @enderror" id="district_id" name="district_id" disabled>
                                            <option value="">Select District</option>
                                        </select>
                                        @error('district_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="sector_id" class="form-label required">Sector</label>
                                        <select class="form-control @error('sector_id') is-invalid @enderror" id="sector_id" name="sector_id" disabled>
                                            <option value="">Select Sector</option>
                                        </select>
                                        @error('sector_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="department_id" class="form-label required">Department</label>
                                        <select class="form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id">
                                            <option value="">Select Department</option>
                                            @foreach (\App\Models\Department::all() as $department)
                                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cv_path" class="form-label required">CV</label>
                                        <input type="file" class="form-control @error('cv_path') is-invalid @enderror" id="cv_path" name="cv_path" accept=".pdf">
                                        @error('cv_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="degree_path" class="form-label required">Degree</label>
                                        <input type="file" class="form-control @error('degree_path') is-invalid @enderror" id="degree_path" name="degree_path" accept=".pdf">
                                        @error('degree_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="id_passport_path" class="form-label required">ID/Passport</label>
                                        <input type="file" class="form-control @error('id_passport_path') is-invalid @enderror" id="id_passport_path" name="id_passport_path" accept=".pdf,.jpg,.png">
                                        @error('id_passport_path')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">OK</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#completeProfileModal').modal({
                backdrop: 'static',
                keyboard: false
            });

            $('#province_id').change(function () {
                var provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: '{{ route("districts.byProvince") }}',
                        type: 'GET',
                        data: { province_id: provinceId },
                        success: function (data) {
                            $('#district_id').empty().append('<option value="">Select District</option>');
                            $.each(data, function (key, value) {
                                $('#district_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                            $('#district_id').prop('disabled', false);
                            $('#sector_id').prop('disabled', true).empty().append('<option value="">Select Sector</option>');
                        }
                    });
                } else {
                    $('#district_id').prop('disabled', true).empty().append('<option value="">Select District</option>');
                    $('#sector_id').prop('disabled', true).empty().append('<option value="">Select Sector</option>');
                }
            });

            $('#district_id').change(function () {
                var districtId = $(this).val();
                if (districtId) {
                    $.ajax({
                        url: '{{ route("sectors.byDistrict") }}',
                        type: 'GET',
                        data: { district_id: districtId },
                        success: function (data) {
                            $('#sector_id').empty().append('<option value="">Select Sector</option>');
                            $.each(data, function (key, value) {
                                $('#sector_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                            $('#sector_id').prop('disabled', false);
                        }
                    });
                } else {
                    $('#sector_id').prop('disabled', true).empty().append('<option value="">Select Sector</option>');
                }
            });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Profile - Ishakiro Job Solution</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-form-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        .section-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }
        .section-card h3 {
            color: #343a40;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .form-control:disabled {
            background-color: #e9ecef;
            color: #6c757d;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="profile-form-container">
        <h1 class="text-center mb-5">Complete Your Profile</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form id="profile-create-form" enctype="multipart/form-data">
            @csrf

            <!-- User Info Section -->
            <div class="section-card">
                <h3>User Info</h3>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" value="{{ $user->name }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" value="{{ $user->phone }}" disabled>
                </div>
            </div>

            <!-- Motivation Section -->
            <div class="section-card">
                <h3>Motivation (Optional)</h3>
                <div class="mb-3">
                    <label for="motivation" class="form-label">Why do you think you are well-suited for jobs you apply to?</label>
                    <textarea class="form-control @error('motivation') is-invalid @enderror" id="motivation" name="motivation" rows="4" placeholder="Share your motivation...">{{ old('motivation') }}</textarea>
                    @error('motivation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Location Section -->
            <div class="section-card">
                <h3>Location</h3>
                <div class="mb-3">
                    <label for="province_id" class="form-label">Province (Optional)</label>
                    <select class="form-control @error('province_id') is-invalid @enderror" id="province_id" name="province_id">
                        <option value="">Select Province</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                    @error('province_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="district_id" class="form-label">District (Optional)</label>
                    <select class="form-control @error('district_id') is-invalid @enderror" id="district_id" name="district_id">
                        <option value="">Select District</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }} ({{ $district->province->name }})</option>
                        @endforeach
                    </select>
                    @error('district_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="sector_id" class="form-label">Sector (Optional)</label>
                    <select class="form-control @error('sector_id') is-invalid @enderror" id="sector_id" name="sector_id">
                        <option value="">Select Sector</option>
                        @foreach($sectors as $sector)
                            <option value="{{ $sector->id }}">{{ $sector->name }} ({{ $sector->district->name }})</option>
                        @endforeach
                    </select>
                    @error('sector_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Education & Experience Section -->
            <div class="section-card">
                <h3>Education & Experience</h3>
                <div class="mb-3">
                    <label for="department_id" class="form-label">Department (Optional)</label>
                    <select class="form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id">
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cv" class="form-label">Upload CV (PDF)</label>
                    <input type="file" class="form-control @error('cv') is-invalid @enderror" id="cv" name="cv" accept="application/pdf" required>
                    @error('cv')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="degree" class="form-label">Upload Degree (PDF)</label>
                    <input type="file" class="form-control @error('degree') is-invalid @enderror" id="degree" name="degree" accept="application/pdf" required>
                    @error('degree')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="id_passport" class="form-label">Upload ID or Passport (PDF, Optional)</label>
                    <input type="file" class="form-control @error('id_passport') is-invalid @enderror" id="id_passport" name="id_passport" accept="application/pdf">
                    @error('id_passport')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="experience_years" class="form-label">Years of Experience</label>
                    <input type="number" class="form-control @error('experience_years') is-invalid @enderror" id="experience_years" name="experience_years" min="0" required>
                    @error('experience_years')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Complete Profile</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('profile-create-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            axios.post('{{ route('profile.store') }}', formData)
                .then(response => {
                    alert('Profile created successfully!');
                    window.location.href = '{{ route('dashboard') }}';
                })
                .catch(error => {
                    if (error.response && error.response.data.errors) {
                        const errors = error.response.data.errors;
                        for (let field in errors) {
                            const input = document.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('is-invalid');
                                const feedback = input.nextElementSibling;
                                if (feedback && feedback.classList.contains('invalid-feedback')) {
                                    feedback.textContent = errors[field][0];
                                }
                            }
                        }
                    } else {
                        alert('An error occurred. Please try again.');
                    }
                });
        });
    </script>
</body>
</html>

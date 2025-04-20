<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post A Job - JobEntry</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: #28a745 !important;
        }
        .nav-link {
            font-weight: 500;
            text-transform: uppercase;
            color: #333 !important;
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #28a745 !important;
        }
    </style>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a href="/" class="navbar-brand">JobEntry</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="#jobs" class="nav-link">Jobs</a></li>
                        <li class="nav-item"><a href="#pages" class="nav-link">Pages</a></li>
                        <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                        <li class="nav-item"><a href="{{ route('jobs.create') }}" class="btn btn-success ms-2">Post A Job</a></li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger ms-2">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Job Posting Form -->
    <section class="py-5">
        <div class="container">
            <h2 class="display-6 font-weight-bold mb-4">Post A Job</h2>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('jobs.store') }}" method="POST" class="card p-4">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" class="form-control" id="company" name="company" value="{{ old('company') }}">
                    @error('company')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}">
                    @error('location')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Job Type</label>
                    <select class="form-control" id="type" name="type">
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                    </select>
                    @error('type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="deadline" class="form-label">Application Deadline</label>
                    <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline') }}">
                    @error('deadline')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-control" id="category_id" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured">
                    <label class="form-check-label" for="is_featured">Mark as Featured</label>
                </div>
                <button type="submit" class="btn btn-primary">Post Job</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5 class="font-weight-bold">ELECTRIX</h5>
                    <p>KN 82 Street, Nyarugenge, Kigali, Rwanda</p>
                    <p>Phone: +250 785 257 667</p>
                    <p>Email: info@electrix.rw</p>
                </div>
                <div class="col-md-3">
                    <h5 class="font-weight-bold">Useful Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="#about" class="text-white text-decoration-none">About us</a></li>
                        <li><a href="#services" class="text-white text-decoration-none">Services</a></li>
                        <li><a href="#products" class="text-white text-decoration-none">Products</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="font-weight-bold">Our Services</h5>
                    <ul class="list-unstyled">
                        <li>Web Development</li>
                        <li>Smart Metering</li>
                        <li>Mobile Apps</li>
                        <li>24/7 Help & Support</li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="font-weight-bold">Our Social Networks</h5>
                    <p>Follow us on social media platforms</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>© 2025 ELECTRIX Ltd. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

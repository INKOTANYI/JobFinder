<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobEntry - Find Your Dream Job</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
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
        .hero-section {
            background: linear-gradient(135deg, #28a745 0%, #0d6efd 100%);
            color: white;
            padding: 5rem 0;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3rem;
            font-weight: 700;
        }
        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .nav-pills .nav-link {
            font-weight: 500;
            color: #333;
            padding: 0.5rem 1.5rem;
            border-radius: 0;
        }
        .nav-pills .nav-link.active {
            background-color: transparent;
            color: #0d6efd;
            border-bottom: 3px solid #0d6efd;
        }
        .job-item {
            background-color: #fff;
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .job-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 0.75rem 2rem;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
        .btn-light.btn-square {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }
        .btn-light.btn-square:hover {
            background-color: #f8f9fa;
        }
        footer {
            background-color: #212529;
        }
        footer h5 {
            font-weight: 600;
        }
        footer a {
            color: #adb5bd;
            transition: color 0.3s ease;
        }
        footer a:hover {
            color: #fff;
        }
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }
            .job-item .row {
                flex-direction: column;
                text-align: center;
            }
            .job-item .col-md-4 {
                align-items: center !important;
            }
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
                        @auth
                            <li class="nav-item"><a href="{{ route('dashboard') }}" class="btn btn-success ms-2">Dashboard</a></li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger ms-2">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-outline-primary ms-2">Login</a></li>
                            <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-primary ms-2">Register</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Discover Your Perfect Job</h1>
            <p>Join JobEntry and explore opportunities tailored for you</p>
            <a href="#jobs" class="btn btn-light btn-lg">Explore Jobs</a>
        </div>
    </section>

    <!-- Jobs Section -->
    <section class="py-5" id="jobs">
        <div class="container">
            @if(session('error'))
                <div class="alert alert-warning text-center">
                    {{ session('error') }}
                </div>
            @endif
            <h1 class="text-center mb-5">Job Listing</h1>
            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="pill" href="#tab-1">Featured</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#tab-2">Full Time</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="pill" href="#tab-3">Part Time</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Featured Jobs -->
                    <div id="tab-1" class="tab-pane fade show active">
                        @forelse ($jobs->where('is_featured', 1) as $job)
                            <div class="job-item p-4 mb-4 border">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="/img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3">{{ $job->title }}</h5>
                                            <span class="text-truncate me-3"><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $job->location }}</span>
                                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $job->type }}</span>
                                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>Negotiable</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <a class="btn btn-light btn-square me-3" href="#"><i class="far fa-heart text-primary"></i></a>
                                            <a class="btn btn-primary" href="{{ auth()->check() ? route('jobs.apply', $job->id) : route('login') }}">Apply Now</a>
                                        </div>
                                        <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Deadline: {{ $job->deadline ? $job->deadline->format('d M Y') : 'N/A' }}</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No featured jobs available.</p>
                        @endforelse
                        <div class="text-center">
                            <a class="btn btn-primary" href="#">Browse More Jobs</a>
                        </div>
                    </div>
                    <!-- Full Time Jobs -->
                    <div id="tab-2" class="tab-pane fade">
                        @forelse ($jobs->where('type', 'Full Time') as $job)
                            <div class="job-item p-4 mb-4 border">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="/img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3">{{ $job->title }}</h5>
                                            <span class="text-truncate me-3"><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $job->location }}</span>
                                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $job->type }}</span>
                                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>Negotiable</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <a class="btn btn-light btn-square me-3" href="#"><i class="far fa-heart text-primary"></i></a>
                                            <a class="btn btn-primary" href="{{ auth()->check() ? route('jobs.apply', $job->id) : route('login') }}">Apply Now</a>
                                        </div>
                                        <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Deadline: {{ $job->deadline ? $job->deadline->format('d M Y') : 'N/A' }}</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No full-time jobs available.</p>
                        @endforelse
                        <div class="text-center">
                            <a class="btn btn-primary" href="#">Browse More Jobs</a>
                        </div>
                    </div>
                    <!-- Part Time Jobs -->
                    <div id="tab-3" class="tab-pane fade">
                        @forelse ($jobs->where('type', 'Part Time') as $job)
                            <div class="job-item p-4 mb-4 border">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="/img/com-logo-1.jpg" alt="" style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3">{{ $job->title }}</h5>
                                            <span class="text-truncate me-3"><i class="fas fa-map-marker-alt text-primary me-2"></i>{{ $job->location }}</span>
                                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{ $job->type }}</span>
                                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>Negotiable</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <a class="btn btn-light btn-square me-3" href="#"><i class="far fa-heart text-primary"></i></a>
                                            <a class="btn btn-primary" href="{{ auth()->check() ? route('jobs.apply', $job->id) : route('login') }}">Apply Now</a>
                                        </div>
                                        <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Deadline: {{ $job->deadline ? $job->deadline->format('d M Y') : 'N/A' }}</small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No part-time jobs available.</p>
                        @endforelse
                        <div class="text-center">
                            <a class="btn btn-primary" href="#">Browse More Jobs</a>
                        </div>
                    </div>
                </div>
            </div>
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

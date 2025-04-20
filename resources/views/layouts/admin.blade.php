<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - Job Portal')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- Custom CSS for smoother cards and sidebar -->
    <style>
        body {
            background-color: #f4f6f9 !important;
            font-family: 'Source Sans Pro', sans-serif !important;
        }
        .main-header {
            z-index: 1000 !important;
            border-bottom: 1px solid #dee2e6 !important;
            background-color: #fff !important;
        }
        .info-box {
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
            cursor: pointer !important;
            border-radius: 15px !important;
            overflow: hidden !important;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1) !important;
            background-color: #fff !important;
        }
        .info-box:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15) !important;
        }
        .info-box-icon {
            font-size: 2.5rem !important;
            line-height: 1 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 70px !important;
            height: 70px !important;
            margin: 0 !important;
            border-radius: 15px 0 0 15px !important;
            background-color: rgba(0, 0, 0, 0.1) !important;
        }
        .info-box-content {
            padding: 20px !important;
        }
        .info-box-text {
            font-size: 1.2rem !important;
            font-weight: 600 !important;
            color: #333 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }
        .info-box-number {
            font-size: 1.8rem !important;
            font-weight: bold !important;
            color: #1f2a44 !important;
        }
        .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease, padding-left 0.3s ease !important;
            border-radius: 5px !important;
            margin: 2px 5px !important;
        }
        .nav-link:hover {
            background-color: #343a40 !important;
            color: #fff !important;
            padding-left: 20px !important;
        }
        .nav-link.active {
            background-color: #007bff !important;
            color: #fff !important;
        }
        .main-sidebar {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        }
        .content-wrapper {
            padding: 20px !important;
        }
        .main-footer {
            border-top: 1px solid #dee2e6 !important;
            background-color: #fff !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ url('/') }}" class="nav-link">Home</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i> {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="fas fa-user-edit mr-2"></i> Edit Profile
                    </a>
                    <a href="{{ route('logout') }}" class="dropdown-item logout-link">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/') }}" class="brand-link">
            <span class="brand-text font-weight-light">Job Portal</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="{{ route('profile.edit') }}" class="d-block">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jobs.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Jobs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.provinces.create') }}" class="nav-link {{ Route::is('admin.provinces.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-map-marker-alt"></i>
                            <p>Create Province</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.districts.create') }}" class="nav-link {{ Route::is('admin.districts.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-map-marked"></i>
                            <p>Create District</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.sectors.create') }}" class="nav-link {{ Route::is('admin.sectors.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-map-pin"></i>
                            <p>Create Sector</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.departments.create') }}" class="nav-link {{ Route::is('admin.departments.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>Create Department</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <footer class="main-footer">
        <strong>Job Portal © 2025</strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE JS -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.logout-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out of your admin account.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, log me out!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    });
</script>
</body>
</html>
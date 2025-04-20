<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Ishakiro Job Solution</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .header {
            background-color: #1a202c;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .nav {
            background-color: #2d3748;
            padding: 10px;
            margin-bottom: 20px;
        }
        .nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
        }
        .nav a:hover {
            text-decoration: underline;
        }
        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #e53e3e;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .btn {
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }
        .btn-approve {
            background-color: #38a169;
            color: white;
        }
        .btn-delete {
            background-color: #e53e3e;
            color: white;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group button {
            background-color: #e53e3e;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #c53030;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Ishakiro Job Solution - Admin Dashboard</h1>
    </div>

    <div class="nav">
        <a href="{{ route('admin.jobs') }}">Jobs</a>
        <a href="{{ route('admin.applications') }}">Applications</a>
        <a href="{{ route('logout') }}">Logout</a>
    </div>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" style="background-color: #38a169; color: white; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Jobs Table -->
        <div class="table-container">
            <h2>Jobs</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Posted By</th>
                        <th>Approved</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $job)
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->company ?? 'N/A' }}</td>
                            <td>{{ $job->location ?? 'N/A' }}</td>
                            <td>{{ $job->user->name }}</td>
                            <td>{{ $job->is_approved ? 'Yes' : 'No' }}</td>
                            <td>
                                @if (!$job->is_approved)
                                    <a href="{{ route('admin.approveJob', $job->id) }}" class="btn btn-approve">Approve</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No jobs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Users Table -->
        <div class="table-container">
            <h2>Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Applications</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->applications_count }}</td>
                            <td>
                                <a href="{{ route('admin.destroyUser', $user->id) }}" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Add Province Form -->
        <div class="form-container">
            <h2>Add Province</h2>
            <form action="{{ route('admin.storeProvince') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Province Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <button type="submit">Add Province</button>
                </div>
            </form>
        </div>

        <!-- Add District Form -->
        <div class="form-container">
            <h2>Add District</h2>
            <form action="{{ route('admin.storeDistrict') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">District Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="province_id">Province</label>
                    <select name="province_id" id="province_id" required>
                        <option value="">Select Province</option>
                        @foreach (\App\Models\Province::all() as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Add District</button>
                </div>
            </form>
        </div>

        <!-- Add Sector Form -->
        <div class="form-container">
            <h2>Add Sector</h2>
            <form action="{{ route('admin.storeSector') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Sector Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="district_id">District</label>
                    <select name="district_id" id="district_id" required>
                        <option value="">Select District</option>
                        @foreach (\App\Models\District::all() as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Add Sector</button>
                </div>
            </form>
        </div>

        <!-- Add Department Form -->
        <div class="form-container">
            <h2>Add Department</h2>
            <form action="{{ route('admin.storeDepartment') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Department Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <button type="submit">Add Department</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

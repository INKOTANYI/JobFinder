<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications - Admin Dashboard</title>
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
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
        <div class="table-container">
            <h2>All Applications</h2>
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Applied On</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applications as $application)
                        <tr>
                            <td>{{ $application->user->name }}</td>
                            <td>{{ $application->job->title }}</td>
                            <td>{{ $application->job->company ?? 'N/A' }}</td>
                            <td>{{ $application->job->location ?? 'N/A' }}</td>
                            <td>{{ $application->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No applications found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

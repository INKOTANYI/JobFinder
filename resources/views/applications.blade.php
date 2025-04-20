<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications - Ishakiro Job Solution</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f4f4f4;
        }
        .sidebar {
            width: 200px;
            background-color: #1a202c;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
        }
        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 0;
        }
        .sidebar a:hover {
            background-color: #2d3748;
            padding-left: 10px;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
            width: calc(100% - 220px);
        }
        .header {
            background-color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .table-container {
            background-color: #fff;
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
    <div class="sidebar">
        <h2>Ishakiro Job Solution</h2>
        <a href="{{ route('dashboard') }}">Home</a>
        <a href="#">Account Management</a>
        <a href="{{ route('applications') }}">My Applications</a>
        <a href="#">Downloads</a>
        <a href="#">Information</a>
        <a href="#">Support</a>
        <a href="#">TnC</a>
    </div>

    <div class="content">
        <div class="header">
            <h1>My Applications</h1>
            <div>
                <span>User: {{ auth()->user()->name }}</span>
                <a href="{{ route('logout') }}" class="btn" style="background-color: #e53e3e; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-left: 10px;">Logout</a>
            </div>
        </div>

        <div class="table-container">
            <h2>Your Job Applications</h2>
            <table>
                <thead>
                    <tr>
                        <th>Job Title</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Applied On</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applications as $application)
                        <tr>
                            <td>{{ $application->job->title }}</td>
                            <td>{{ $application->job->company ?? 'N/A' }}</td>
                            <td>{{ $application->job->location ?? 'N/A' }}</td>
                            <td>{{ $application->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No applications found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

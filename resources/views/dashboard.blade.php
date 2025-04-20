@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Dashboard Cards -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="card info-box shadow-sm" data-type="jobs">
            <div class="card-body d-flex align-items-center">
                <span class="info-box-icon bg-info mr-3"><i class="fas fa-briefcase"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Total Jobs</span>
                    <span class="info-box-number h4 mb-0">{{ $stats['total_jobs'] }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card info-box shadow-sm" data-type="users">
            <div class="card-body d-flex align-items-center">
                <span class="info-box-icon bg-success mr-3"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Total Users</span>
                    <span class="info-box-number h4 mb-0">{{ $stats['total_users'] }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card info-box shadow-sm" data-type="applications">
            <div class="card-body d-flex align-items-center">
                <span class="info-box-icon bg-primary mr-3"><i class="fas fa-file-alt"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Total Applications</span>
                    <span class="info-box-number h4 mb-0">{{ $stats['total_applications'] }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="card info-box shadow-sm" data-type="pending_applications">
            <div class="card-body d-flex align-items-center">
                <span class="info-box-icon bg-warning mr-3"><i class="fas fa-hourglass-half"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text text-muted">Pending Applications</span>
                    <span class="info-box-number h4 mb-0">{{ $stats['pending_applications'] }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Data Display Container -->
<div class="card mb-4" id="data-container" style="display: none;">
    <div class="card-header">
        <h3 class="card-title" id="data-title"></h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="data-table">
            <thead id="data-table-head"></thead>
            <tbody id="data-table-body"></tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Make cards clickable
    document.querySelectorAll('.info-box').forEach(card => {
        card.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            let url, title;

            if (type === 'jobs') {
                url = '{{ route('dashboard.jobs') }}';
                title = 'List of Jobs';
            } else if (type === 'users') {
                url = '{{ route('dashboard.users') }}';
                title = 'List of Users';
            } else if (type === 'applications') {
                url = '{{ route('dashboard.applications') }}';
                title = 'List of Applications';
            } else if (type === 'pending_applications') {
                url = '{{ route('dashboard.applications.pending') }}';
                title = 'List of Pending Applications';
            }

            fetchData(url, title, type);
        });
    });
});

// Fetch and display data for clickable cards
function fetchData(url, title, type) {
    fetch(url, {
        headers: {
            'Accept': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('data-container');
        const dataTitle = document.getElementById('data-title');
        const thead = document.getElementById('data-table-head');
        const tbody = document.getElementById('data-table-body');

        dataTitle.textContent = title;
        thead.innerHTML = '';
        tbody.innerHTML = '';
        container.style.display = 'block';

        if (type === 'jobs') {
            thead.innerHTML = `
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Company</th>
                    <th>Posted By</th>
                    <th>Created At</th>
                </tr>
            `;
            data.forEach(item => {
                const row = `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.title}</td>
                        <td>${item.company}</td>
                        <td>${item.user ? item.user.name : 'N/A'}</td>
                        <td>${new Date(item.created_at).toLocaleString()}</td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        } else if (type === 'users') {
            thead.innerHTML = `
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            `;
            data.forEach(item => {
                const row = `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>${item.email}</td>
                        <td>${new Date(item.created_at).toLocaleString()}</td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        } else if (type === 'applications' || type === 'pending_applications') {
            thead.innerHTML = `
                <tr>
                    <th>ID</th>
                    <th>Applicant</th>
                    <th>Job Title</th>
                    <th>Status</th>
                    <th>Applied At</th>
                </tr>
            `;
            data.forEach(item => {
                const row = `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.user ? item.user.name : 'N/A'}</td>
                        <td>${item.job ? item.job.title : 'N/A'}</td>
                        <td>${item.status}</td>
                        <td>${new Date(item.created_at).toLocaleString()}</td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Failed to fetch data: ' + error.message,
        });
    });
}
</script>
@endsection
@extends('layouts.app')

@section('title', 'Job Listings')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h1 class="card-title">Discover Your Perfect Job</h1>
                        <p class="card-text">Join Ishakiro Job Solution and explore opportunities tailored for you</p>
                        <a href="#job-listing" class="btn btn-primary">Explore Jobs</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <select id="category-filter" class="form-control">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="sector-filter" class="form-control">
                    <option value="">All Sectors</option>
                    @foreach ($sectors as $sector)
                        <option value="{{ $sector->id }}">{{ $sector->name }} ({{ $sector->district->name }}, {{ $sector->district->province->name }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" id="search-filter" class="form-control" placeholder="Search jobs...">
            </div>
        </div>

        <div id="job-listing">
            <h2>Job Listing</h2>
            <div id="jobs-container" class="row">
                <!-- Jobs will be loaded here via AJAX -->
            </div>
            <div id="pagination-container" class="mt-4"></div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                let currentPage = 1;

                // Load jobs with filters
                function loadJobs(page = 1) {
                    let category_id = $('#category-filter').val();
                    let sector_id = $('#sector-filter').val();
                    let search = $('#search-filter').val();

                    $.ajax({
                        url: '{{ route("jobs.index") }}',
                        method: 'GET',
                        data: {
                            category_id: category_id,
                            sector_id: sector_id,
                            search: search,
                            page: page
                        },
                        success: function(response) {
                            let jobsContainer = $('#jobs-container');
                            jobsContainer.empty();

                            if (response.jobs.length === 0) {
                                jobsContainer.append('<div class="col-12"><p class="text-center">No jobs available at the moment. Check back later!</p></div>');
                            } else {
                                response.jobs.forEach(job => {
                                    let jobCard = `
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h5 class="card-title">${job.title}</h5>
                                                    <p class="card-text"><strong>Company:</strong> ${job.company ?? 'N/A'}</p>
                                                    <p class="card-text"><strong>Location:</strong> ${job.location ?? 'N/A'}</p>
                                                    <p class="card-text"><strong>Category:</strong> ${job.category?.name ?? 'N/A'}</p>
                                                </div>
                                                <div class="card-footer">
                                                    <a href="/jobs/${job.id}" class="btn btn-primary btn-sm">View Details</a>
                                                </div>
                                            </div>
                                        </div>`;
                                    jobsContainer.append(jobCard);
                                });
                            }

                            $('#pagination-container').html(response.pagination);
                        },
                        error: function() {
                            $('#jobs-container').html('<div class="col-12"><p class="text-center text-danger">Failed to load jobs.</p></div>');
                        }
                    });
                }

                // Initial load
                loadJobs();

                // Filter change handlers
                $('#category-filter, #sector-filter').on('change', function() {
                    currentPage = 1;
                    loadJobs();
                });

                $('#search-filter').on('input', function() {
                    currentPage = 1;
                    loadJobs();
                });

                // Pagination click handler
                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    currentPage = page;
                    loadJobs(page);
                });
            });
        </script>
    @endsection
@endsection

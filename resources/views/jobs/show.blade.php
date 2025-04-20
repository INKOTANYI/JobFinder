@extends('layouts.app')

@section('title', 'Job Details')

@section('content')
    <div class="container">
        <h1>Job Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $job->title }}</h5>
                <p class="card-text"><strong>Company:</strong> {{ $job->company ?? 'N/A' }}</p>
                <p class="card-text"><strong>Location:</strong> {{ $job->location ?? 'N/A' }}</p>
                <p class="card-text"><strong>Category:</strong> {{ $job->category->name ?? 'N/A' }}</p>
                <p class="card-text"><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($job->deadline)->format('Y-m-d') }}</p>
                <p class="card-text"><strong>Description:</strong> {{ $job->description }}</p>
                <p class="card-text"><strong>Posted By:</strong> {{ $job->user->name ?? 'N/A' }}</p>

                @auth
                    @if($hasApplied)
                        <p class="text-info">You have already applied for this job.</p>
                    @else
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applyModal">Apply Now</button>
                    @endif
                @else
                    <p>Please <a href="{{ route('login') }}">log in</a> to apply for this job.</p>
                @endauth

                <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Back to Jobs</a>
            </div>
        </div>
    </div>

    <!-- Apply Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Apply for {{ $job->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="apply-form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cover_letter">Cover Letter <span class="text-danger">*</span></label>
                            <textarea name="cover_letter" id="cover_letter" class="form-control" rows="5"></textarea>
                            <span class="text-danger" id="cover_letter-error"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#apply-form').on('submit', function(e) {
                    e.preventDefault();
                    let data = {
                        cover_letter: $('#cover_letter').val(),
                        _token: '{{ csrf_token() }}'
                    };

                    $('#cover_letter-error').text('');

                    $.ajax({
                        url: '{{ route("jobs.apply", $job) }}',
                        method: 'POST',
                        data: data,
                        success: function(response) {
                            $('#applyModal').modal('hide');
                            alert(response.message);
                            location.reload();
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                if (errors.cover_letter) {
                                    $('#cover_letter-error').text(errors.cover_letter[0]);
                                }
                            } else {
                                $('#applyModal').modal('hide');
                                alert(xhr.responseJSON.message || 'Failed to submit application.');
                            }
                        }
                    });
                });
            });
        </script>
    @endsection
@endsection

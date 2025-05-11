@extends('admin.layout.master')

@section('content')

<div class="main-content">
    @section('header')
        <h4 class="fw-bold text-uppercase text-primary">
            <i class="fa-solid fa-envelope-open-text me-2"></i> Feedback Message Details
        </h4>
    @endsection

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-8 offset-lg-2">
                <div class="card shadow border-0 rounded">
                    <!-- ✅ Modern Header Design -->
                    <div class="card-header bg-gradient-primary text-black text-center py-3 rounded-top">
                        <h3 class="fw-bold mb-0"><i class="fa-solid fa-message me-2"></i> Message Details</h3>
                    </div>

                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <!-- ✅ Styled Labels with Icons -->
                            <div class="col-md-3 fw-bold text-secondary">
                                <p class="mb-3"><i class="fa-solid fa-user me-2"></i> Name:</p>
                                <p class="mb-3"><i class="fa-solid fa-envelope me-2"></i> Email:</p>
                                <p class="mb-3"><i class="fa-solid fa-calendar-alt me-2"></i> Sent Date:</p>
                                <p class="mb-3"><i class="fa-solid fa-bookmark me-2"></i> Subject:</p>
                                <p class="mb-3"><i class="fa-solid fa-comment-dots me-2"></i> Message:</p>
                            </div>

                            <!-- ✅ Displaying Message Details -->
                            <div class="col-md-9 text-dark">
                                <p class="mb-3">{{ $message->name }}</p>
                                <p class="mb-3">
                                    <a href="mailto:{{ $message->email }}" class="text-primary text-decoration-none">
                                        {{ $message->email }}
                                    </a>
                                </p>
                                <p class="mb-3">{{ $message->created_at->format('F j, Y') }}</p>
                                <p class="mb-3 fw-bold text-primary">{{ $message->subject }}</p>
                                <div class="border p-3 bg-light rounded">
                                    <p class="mb-0 text-justify" style="white-space: pre-wrap;">{{ $message->message }}</p>
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <!-- ✅ Button Actions (Back & Delete) -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin#feedbackPage') }}" class="btn btn-outline-primary px-4">
                                <i class="fa-solid fa-arrow-left me-2"></i> Back
                            </a>
                            <button class="btn btn-danger px-4 delete-message" data-id="{{ $message->id }}">
                                <i class="fa-solid fa-trash me-2"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scriptSource')

<!-- ✅ Delete Confirmation Script -->
<script>
    $('.delete-message').click(function() {
        let message_id = $(this).data('id');

        Swal.fire({
            title: "Are you sure?",
            text: "This message will be permanently deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, Delete"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: '/admin/feedback/delete',
                    data: { message_id: message_id },
                    success: function() {
                        Swal.fire('Deleted!', 'Message has been removed.', 'success')
                        .then(() => {
                            window.location.href = "{{ route('admin#feedbackPage') }}"; // Redirect after deletion
                        });
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });
</script>

<!-- ✅ SweetAlert2 Library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection

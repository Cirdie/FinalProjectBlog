@extends('admin.layout.master')

@section('title', 'Post Detail')

@section('content')

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow rounded border-0">

                    <!-- Post Status (Approved / Pending) -->
                    <div class="d-flex justify-content-between align-items-center p-3 bg-light">
                        <h5 class="card-title fw-bold text-primary border-start border-4 border-dark ps-3 mb-0">
                            {{ $post->topic_name }}
                        </h5>

                        @switch($post->approved)
                            @case(true)
                                <span class="badge bg-success">Approved</span>
                                @break
                            @default
                                <span class="badge bg-warning text-dark">Pending Approval</span>
                        @endswitch
                    </div>

                    <!-- Post Author Info -->
                    <div class="d-flex align-items-center ms-3 mt-2">
                        <div class="rounded-circle overflow-hidden border" style="width: 55px; height: 55px;">
                            @if ($post->profile_image)
                                <img src="{{ asset('storage/'.$post->profile_image) }}" class="w-100 h-100" style="object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $post->admin_name }}" class="w-100 h-100" style="object-fit: cover;">
                            @endif
                        </div>
                        <div class="ms-2">
                            <span class="fw-semibold fs-6">{{ $post->admin_name }}</span><br>
                            <span class="text-muted fs-6">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <!-- Post Image -->
                    <div class="p-3 text-center">
                        @if ($post->image)
                            <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid rounded border border-dark">
                        @else
                            <img src="{{ asset('images/alert gif/postimg.jpg') }}" class="img-fluid rounded border border-dark">
                        @endif
                    </div>

                    <!-- Post Content -->
                    <div class="card-body">
                        <p class="card-text" style="white-space: pre-wrap;">{{ $post->desc }}</p>
                        <hr>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="fs-5 text-primary" style="cursor: pointer;">
                                <i class="fa-solid fa-bookmark"></i>
                                <span>{{ $post->save_count }}</span>
                            </div>

                            <div class="d-flex gap-2">
                                <!-- Approve Button (Visible Only for Pending Posts) -->
                                @if (!$post->approved)
                                    <button class="btn btn-success btn-approve" data-id="{{ $post->id }}">
                                        <i class="fa-solid fa-check me-2"></i>Approve
                                    </button>
                                @endif

                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-delete" data-id="{{ $post->id }}">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>

                                <!-- Back Button -->
                                <a href="{{ route('post#listPage') }}" class="btn btn-primary">
                                    <i class="fa-solid fa-arrow-left me-2"></i>Back
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->

@endsection

@section('scriptSource')
<script>
    // ✅ Delete Post with Instant UI Update
    $('.btn-delete').click(function() {
        let button = $(this);
        let post_id = button.data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This post will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: '/admin/post/delete',
                    data: { post_id: post_id },
                    success: function() {
                        Swal.fire('Deleted!', 'Post has been removed.', 'success')
                        .then(() => window.location.href = "{{ route('post#listPage') }}");
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });

    // ✅ Approve Post with Confirmation
    $('.btn-approve').click(function() {
        let button = $(this);
        let post_id = button.data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to approve this post?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '/admin/post/approve/' + post_id,
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        Swal.fire('Approved!', 'The post has been approved.', 'success')
                        .then(() => location.reload()); // Refresh the page
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        Swal.fire('Error!', 'Something went wrong. Check the console.', 'error');
                    }
                });
            }
        });
    });

</script>
@endsection

@if (session('createMessage'))
    @section('scriptSource')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('createMessage') }}',
                showConfirmButton: true,
            }).then(() => location.reload());
        </script>
    @endsection
@endif

@if (session('editMessage'))
    @section('scriptSource')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('editMessage') }}',
                showConfirmButton: true,
            }).then(() => location.reload());
        </script>
    @endsection
@endif

@extends('user.layout.master')

@section('title', 'Edit Post')

@section('content')

<style>
    /* Styling for the Edit Post Form */
    .edit-post-container {
        max-width: 700px;
        margin: auto;
    }

    .edit-post-card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.3);
    }

    .btn-custom {
        font-size: 16px;
        font-weight: 500;
        transition: 0.3s ease;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0px 4px 10px rgba(0, 123, 255, 0.2);
    }
</style>

<div class="container pt-5">
    <div class="edit-post-container">
        <div class="edit-post-card">
            <h3 class="text-center fw-bold text-primary mb-4"><i class="fa-solid fa-edit me-2"></i>Edit Your Post</h3>

            <form action="{{route('user#postEdit')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="adminId" value="{{ $post->admin_id }}">
                <input type="hidden" name="postId" value="{{ $post->id }}">

                <!-- Name (Readonly) -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Your Name</label>
                    <input type="text" class="form-control bg-light" readonly value="{{ Auth::user()->name }}">
                </div>

                <!-- Topic Selection -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Topic</label>
                    <select name="topicId" class="form-select @error('topicId') is-invalid @enderror">
                        <option value="">Choose a topic</option>
                        @foreach ($topics as $t)
                            <option value="{{ $t->id }}" @if(old('topicId') == $t->id || $t->id == $post->topic_id) selected @endif>
                                {{ $t->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('topicId')
                        <span class="text-danger d-block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Change Image</label>
                    <input type="file" name="postImage" class="form-control @error('postImage') is-invalid @enderror">
                    @error('postImage')
                        <span class="text-danger d-block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Post Content -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Edit Content</label>
                    <textarea name="desc" rows="5" class="form-control @error('desc') is-invalid @enderror" placeholder="Update your content...">{{ old('desc', $post->desc) }}</textarea>
                    @error('desc')
                        <span class="text-danger d-block">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{route('user#postHome')}}" class="btn btn-outline-secondary btn-custom">
                        <i class="fa-solid fa-arrow-left me-2"></i>Back
                    </a>
                    <button type="submit" class="btn btn-primary btn-custom">
                        <i class="fa-solid fa-upload me-2"></i>Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 🔥 SweetAlert for Error Handling -->
@if (session('error'))
    @section('scriptSource')
        <script>
            Swal.fire({
                icon: 'error',
                text: '{{ session('error') }}',
                showConfirmButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        </script>
    @endsection
@endif

@endsection

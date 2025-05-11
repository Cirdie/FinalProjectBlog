@extends('user.layout.master')

@section('title', 'Update Information')

@section('content')

<style>
    /* Profile Card Styling */
    .update-card {
        max-width: 850px;
        margin: auto;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
        transition: 0.3s ease-in-out;
    }

    .update-card:hover {
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Profile Image Styling */
    .profile-img {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 50%;
        display: block;
        margin: auto;
        border: 5px solid #007bff;
        transition: 0.3s;
    }

    .profile-img:hover {
        transform: scale(1.05);
    }

    /* File Input Styling */
    .custom-file-label {
        background-color: #f8f9fa;
        cursor: pointer;
        transition: 0.3s ease-in-out;
    }

    .custom-file-label:hover {
        background-color: #e9ecef;
    }

    /* Input Fields Styling */
    .form-control, .form-select {
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.3);
    }

    /* Action Buttons */
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

<div class="container py-5">
    <div class="update-card">
        <div class="text-center">
            <h3 class="fw-bold text-primary mb-3">
                <i class="fa-solid fa-user-edit me-2"></i> Update Information
            </h3>
        </div>
        <hr>

        <form action="{{ route('user#updateAccount') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ Auth::user()->id }}">

            <div class="row mt-4">
                <!-- Profile Image Section -->
                <div class="col-lg-4 text-center">
                    <div class="mb-3">
                        <label for="profileImage">
                            <img id="previewImage" src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}"
                                 class="profile-img" alt="Profile Image">
                        </label>
                    </div>

                    <div class="custom-file">
                        <input type="file" name="image" id="profileImage" class="form-control custom-file-input @error('image') is-invalid @enderror" onchange="previewFile()">
                        @error('image')
                            <span class="text-danger d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- User Information Section -->
                <div class="col-lg-8">
                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fa-solid fa-user me-2"></i>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" placeholder="Enter Name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fa-solid fa-shield-halved me-2"></i>Role</label>
                        <input type="text" name="role" class="form-control" value="{{ old('role', Auth::user()->role) }}" readonly>
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fa-solid fa-venus-mars me-2"></i>Gender</label>
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                            <option value="">Choose Gender</option>
                            <option value="male" @if(Auth::user()->gender == 'male') selected @endif>Male</option>
                            <option value="female" @if(Auth::user()->gender == 'female') selected @endif>Female</option>
                        </select>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fa-solid fa-envelope me-2"></i>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" placeholder="Enter Email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('user#informationPage') }}" class="btn btn-outline-secondary btn-custom">
                            <i class="fa-solid fa-arrow-left me-2"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="fa-solid fa-arrow-up-from-bracket me-2"></i> Update
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- SweetAlert for Success Message -->
@if (session('updateAlert'))
    @section('scriptSource')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('updateAlert') }}',
                showConfirmButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        </script>
    @endsection
@endif

<!-- JavaScript to Preview Image Before Upload -->
<script>
    function previewFile() {
        const file = document.getElementById('profileImage').files[0];
        const preview = document.getElementById('previewImage');

        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                preview.src = reader.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection

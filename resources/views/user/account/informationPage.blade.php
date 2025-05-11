@extends('user.layout.master')

@section('title', 'Personal Information')

@section('content')

<style>
    /* Profile Card Styling */
    .profile-card {
        max-width: 750px;
        margin: auto;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
        transition: 0.3s ease-in-out;
    }

    .profile-card:hover {
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

    /* Input Fields Styling */
    .form-control {
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .form-control:focus {
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
    <div class="profile-card">
        <div class="text-center">
            <h3 class="fw-bold text-primary mb-3">
                <i class="fa-solid fa-user-circle me-2"></i> Personal Information
            </h3>
        </div>
        <hr>

        <div class="row mt-4">
            <!-- Profile Image Section -->
            <div class="col-lg-4 text-center">
                <div class="mb-3">
                    @if (Auth::user()->image)
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" class="profile-img" alt="Profile Image">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="profile-img" alt="Default Avatar">
                    @endif
                </div>
            </div>

            <!-- User Information -->
            <div class="col-lg-8">
                <form>
                    @csrf
                    <!-- Name -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fa-solid fa-user me-2"></i>Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fa-solid fa-shield-halved me-2"></i>Role</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->role }}" readonly>
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fa-solid fa-venus-mars me-2"></i>Gender</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->gender }}" readonly>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fa-solid fa-envelope me-2"></i>Email</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->email }}" readonly>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('user#home') }}" class="btn btn-outline-secondary btn-custom">
                            <i class="fa-solid fa-arrow-left me-2"></i> Back
                        </a>
                        <a href="{{ route('user#updateAccountPage') }}" class="btn btn-primary btn-custom">
                            <i class="fa-solid fa-pen-to-square me-2"></i> Edit Information
                        </a>
                    </div>
                </form>
            </div>
        </div>
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

@endsection

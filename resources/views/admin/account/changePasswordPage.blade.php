@extends('admin.layout.master')

@section('title', 'Change Password')

@section('content')

<style>
    /* Card Styling */
    .password-card {
        border-radius: 12px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease-in-out;
    }

    .password-card:hover {
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Input Field Styling */
    .form-control {
        height: 50px;
        border-radius: 8px;
        font-size: 16px;
    }

    /* Button Styling */
    .btn-primary {
        height: 50px;
        font-size: 18px;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-lg-3">
                <div class="card password-card shadow-lg border-0">
                    <div class="card-body">
                        <div class="card-title text-center">
                            <h3 class="fw-bold text-primary">🔐 Change Password</h3>
                            <p class="text-muted">Secure your account by updating your password.</p>
                        </div>
                        <hr>

                        <form action="{{ route('admin#changePassword') }}" method="post">
                            @csrf

                            <!-- Old Password -->
                            <div class="mb-3">
                                <label class="fw-semibold"><i class="fa-solid fa-lock me-2"></i> Old Password</label>
                                <input type="password" name="oldPassword" class="form-control @if(session('changePasswordFail')) is-invalid @endif @error('oldPassword') is-invalid @enderror" placeholder="Enter Old Password">
                                @error('oldPassword') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                @if(session('changePasswordFail')) <span class="invalid-feedback">{{ session('changePasswordFail') }}</span> @endif
                            </div>

                            <!-- New Password -->
                            <div class="mb-3">
                                <label class="fw-semibold"><i class="fa-solid fa-key me-2"></i> New Password</label>
                                <input type="password" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror" placeholder="Enter New Password">
                                @error('newPassword') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label class="fw-semibold"><i class="fa-solid fa-lock me-2"></i> Confirm Password</label>
                                <input type="password" name="confirmPassword" class="form-control @error('confirmPassword') is-invalid @enderror" placeholder="Confirm New Password">
                                @error('confirmPassword') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <!-- Change Password Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-key me-2"></i> Change Password
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                <!-- Back to Dashboard -->
                <div class="text-center mt-3">
                    <a href="{{ route('admin#home') }}" class="text-decoration-none">
                        <i class="fa-solid fa-arrow-left me-2"></i> Back to Dashboard
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- SweetAlert for Success & Errors -->
@if (session('changePw'))
    @section('scriptSource')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('changePw') }}',
                showConfirmButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        </script>
    @endsection
@endif

@if (session('changePasswordFail'))
    @section('scriptSource')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: '{{ session('changePasswordFail') }}',
                showConfirmButton: true,
            });
        </script>
    @endsection
@endif

@endsection

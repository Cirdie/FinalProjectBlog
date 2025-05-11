@extends('auth.layouts.auth_master')

@section('title', 'Login Form')

@section('content')
<section class="form-container d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="login-container bg-white">
        <div class="row">
            <div class="col-lg-5">
                <div class="bg-primary bg-image border-end"
                     style="background: url('{{ asset('images/Login2.jpeg') }}') center/cover no-repeat; height: 100%;">
                    <!-- Image or content here -->
                </div>
            </div>

            <div class="col-12 col-lg-7 py-4 px-5 py-lg-3">
                <div class="text-end d-flex align-items-center fw-semibold">
                    <span>Do not have an account?</span>
                    <a href="{{ route('register') }}" class="ms-3 btn btn-sm btn-outline-primary fw-semibold">Register</a>
                </div>

                <div class="mt-4 mt-lg-5 login-form-container">
                    <div class="mb-4">
                        <h2 class="fw-semibold fs-4">Welcome to Students' Blog</h2>
                        <p class="mt-3 text-muted fs-6" style="font-size: 21px;">Login to your account</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="pt-lg-4">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label text-primary fw-semibold" style="font-size: 21px;">Email</label>
                            <input name="email" value="{{ old('email') }}" type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Enter email...">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-primary fw-semibold" style="font-size: 21px;">Password</label>
                            <input name="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Enter password...">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <button type="submit" class="btn btn-lg btn-primary py-2 px-4 me-2">Login</button>
                            <a href="{{ route('user#home') }}" class="btn btn-lg btn-outline-success py-2 px-4">Continue as Guest</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@if (session('info'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            text: '{{ session('info') }}',
            showConfirmButton: true,
        })
    </script>
@endif

@if (session('reject'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('reject') }}',
            showConfirmButton: true,
            confirmButtonText: 'OK',
        })
    </script>
@endif
@endsection

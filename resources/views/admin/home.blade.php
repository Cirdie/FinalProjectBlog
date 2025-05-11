@extends('admin.layout.master')

@section('title', 'Admin Dashboard')

@section('caption')
    @parent
    <h2 class="text-center text-secondary mt-3">Welcome to the Admin Panel</h2>
@endsection

@section('content')

<style>
    /* Dashboard Card Styling */
    .dashboard-card {
        transition: 0.3s ease-in-out;
        border-radius: 12px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }

    .dashboard-card:hover {
        transform: translateY(-3px);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Card Icon Styling */
    .dashboard-icon {
        font-size: 3rem;
        transition: 0.3s;
    }

    .dashboard-card:hover .dashboard-icon {
        transform: scale(1.1);
    }

    /* Welcome Section Styling */
    .welcome-section {
        padding: 30px;
        border-radius: 12px;
        background: linear-gradient(135deg, #007bff, #6610f2);
        color: white;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .welcome-section {
            text-align: center;
        }
    }
</style>

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- Welcome Section -->
            <div class="row">
                <div class="col-12">
                    <div class="welcome-section">
                        <h2 class="fw-bold">Hi, {{ Auth::user()->name }} 👋</h2>
                        <h4>Welcome back to your Admin Dashboard!</h4>
                        <p class="mt-2">
                            Stay updated with the latest activity on the platform. Manage users, posts, and much more effortlessly. Let's keep the community engaging and informed! 🚀
                        </p>
                    </div>
                </div>
            </div>

            <!-- Overview Cards -->
            <div class="row mt-4 g-4">
                <div class="col-12 col-md-4">
                    <div class="card text-white bg-primary dashboard-card text-center p-4">
                        <i class="fa-solid fa-users dashboard-icon mb-2"></i>
                        <h3 class="fw-bold">{{ $user_count }}</h3>
                        <p class="mb-0">Total Users</p>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card text-white bg-danger dashboard-card text-center p-4">
                        <i class="fa-solid fa-user-shield dashboard-icon mb-2"></i>
                        <h3 class="fw-bold">{{ $admin_count }}</h3>
                        <p class="mb-0">Admins</p>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card text-white bg-success dashboard-card text-center p-4">
                        <i class="fa-solid fa-newspaper dashboard-icon mb-2"></i>
                        <h3 class="fw-bold">{{ $post_count }}</h3>
                        <p class="mb-0">Total Posts</p>
                    </div>
                </div>
            </div>

            <!-- Platform Summary Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card shadow-lg p-4">
                        <h3 class="fw-bold text-primary">📢 Platform Overview</h3>
                        <p class="text-muted mt-2">
                            Our students' blog is a thriving platform where our admins share insightful and informative posts covering a range of topics, from education and career guidance to lifestyle insights. This dashboard gives you complete control over the platform's content and user engagement.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- SweetAlert for Password Change Success -->
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

@endsection

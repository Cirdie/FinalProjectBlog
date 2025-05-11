<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Dashboard">
    <meta name="author" content="Your Name">
    <meta name="keywords" content="Admin, Dashboard, CMS">

    <!-- Title Page -->
    <title>@yield('title')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome & Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar */
        .menu-sidebar {
            width: 250px;
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #ddd;
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
            overflow-y: auto;
            z-index: 1050;
        }

        .menu-sidebar .nav-link {
            color: #333;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        .menu-sidebar .nav-link i {
            margin-right: 10px;
        }

        /* Mobile Sidebar */
        @media (max-width: 991px) {
            .menu-sidebar {
                left: -250px;
                transition: all 0.3s ease-in-out;
            }

            .menu-sidebar.active {
                left: 0;
            }

            .mobile-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                visibility: hidden;
                opacity: 0;
                transition: opacity 0.3s ease-in-out;
            }

            .mobile-overlay.active {
                visibility: visible;
                opacity: 1;
            }
        }

        /* Page Content */
        .page-container {
            margin-left: 250px;
            padding: 20px;
        }

        @media (max-width: 991px) {
            .page-container {
                margin-left: 0;
            }
        }

        /* Profile Section */
        .profile-section {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }

        .profile-section .profile-info {
            text-align: center;
        }

        .profile-section img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            object-position: center;
        }

        .profile-section .profile-name {
            font-weight: 600;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <!-- Mobile Navbar -->
    <nav class="navbar navbar-light bg-white shadow-sm d-lg-none">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" id="mobile-menu-btn">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mx-auto" href="#">
                <img src="{{ asset('images/logo.png') }}" width="130px" alt="Logo">
            </a>
        </div>
    </nav>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay"></div>

    @include('admin.layout.side')

<!-- Page Content -->
<div class="page-container">
    <!-- Caption Section -->
    <div class="caption-container mb-4">
        @section('caption')
            <h1 class="text-center text-primary">Admin Dashboard</h1>
        @show
    </div>

    <!-- Main Content -->
    @yield('content')
</div>


    <!-- Scripts -->
    <script src="{{ asset('admin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Mobile Sidebar Toggle -->
    <script>
        $(document).ready(function () {
            $('#mobile-menu-btn').click(function () {
                $('.menu-sidebar, .mobile-overlay').toggleClass('active');
            });

            $('.mobile-overlay').click(function () {
                $('.menu-sidebar, .mobile-overlay').removeClass('active');
            });
        });
    </script>

    @yield('scriptSource')

</body>
</html>

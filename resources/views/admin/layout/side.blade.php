<!-- Sidebar -->
<aside class="menu-sidebar">
    <div class="logo text-center">
        <a href="#">
            <img src="{{ asset('images/logo_dark.png') }}" width="150px" alt="Logo">
        </a>
    </div>
    <nav class="navbar-sidebar mt-4">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin#home') }}" class="nav-link"><i class="fa-solid fa-home"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('topic#listPage') }}" class="nav-link"><i class="fa-solid fa-table-list"></i> Topics</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('post#listPage') }}" class="nav-link"><i class="fa-solid fa-newspaper"></i> Posts</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin#adminAccountList') }}" class="nav-link"><i class="fa-solid fa-user-shield"></i> Admins</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin#userAccountList') }}" class="nav-link"><i class="fa-solid fa-user"></i> Users</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin#feedbackPage') }}" class="nav-link"><i class="fa-solid fa-envelope"></i> Feedbacks</a>
            </li>

<!-- Profile Section -->
<li class="profile-section">
    <div class="profile-info">
        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}" alt="Profile">
        <div class="profile-name">{{ Auth::user()->name }}</div>
        <small class="text-muted">{{ Auth::user()->email }}</small>
    </div>

    <ul class="nav flex-column mt-2">
        <!-- ✅ Added Home Page Link -->
        <li class="nav-item">
            <a href="{{ url('/user/home') }}" class="nav-link"><i class="fa-solid fa-house"></i> View Home</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin#informationPage') }}" class="nav-link"><i class="fa-solid fa-user-secret"></i> Account</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin#changePasswordPage') }}" class="nav-link"><i class="fa-solid fa-key"></i> Change Password</a>
        </li>
        <li class="nav-item">
            <!-- 🔹 Logout Button with Confirmation -->
            <form id="sidebarLogoutForm" action="{{ route('logout') }}" method="post" class="px-3 mt-2">
                @csrf
                <button type="button" class="btn btn-danger w-100" onclick="confirmLogoutSidebar()">Logout</button>
            </form>
        </li>
    </ul>
</li>

        </ul>
    </nav>
</aside>

<!-- ✅ JavaScript for Sidebar Logout Confirmation -->
<script>
    function confirmLogoutSidebar() {
        Swal.fire({
            title: "Are you sure?",
            text: "You will be logged out of your account!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, Logout"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('sidebarLogoutForm').submit();
            }
        });
    }
</script>

<!-- ✅ SweetAlert2 Library (For Logout Confirmation) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

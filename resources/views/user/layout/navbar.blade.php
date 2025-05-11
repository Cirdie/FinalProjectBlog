<nav class="navbar navbar-dark navbar-expand-lg bg-dark fixed-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <label class="switch ms-2">
            <span class="sun">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g fill="#ffd43b">
                        <circle r="5" cy="12" cx="12"></circle>
                        <path d="m21 13h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2zm-17 0h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2zm13.66-5.66a1 1 0 0 1 -.66-.29 1 1 0 0 1 0-1.41l.71-.71a1 1 0 1 1 1.41 1.41l-.71.71a1 1 0 0 1 -.75.29zm-12.02 12.02a1 1 0 0 1 -.71-.29 1 1 0 0 1 0-1.41l.71-.66a1 1 0 0 1 1.41 1.41l-.71.71a1 1 0 0 1 -.7.24zm6.36-14.36a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1zm0 17a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1zm-5.66-14.66a1 1 0 0 1 -.7-.29l-.71-.71a1 1 0 0 1 1.41-1.41l.71.71a1 1 0 0 1 0 1.41 1 1 0 0 1 -.71.29zm12.02 12.02a1 1 0 0 1 -.7-.29l-.66-.71a1 1 0 0 1 1.36-1.36l.71.71a1 1 0 0 1 0 1.41 1 1 0 0 1 -.71.24z"></path>
                    </g>
                </svg>
            </span>
            <span class="moon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <path d="m223.5 32c-123.5 0-223.5 100.3-223.5 224s100 224 223.5 224c60.6 0 115.5-24.2 155.8-63.4 5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6-96.9 0-175.5-78.8-175.5-176 0-65.8 36-123.1 89.3-153.3 6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z"></path>
                </svg>
            </span>
            <input type="checkbox" id="flexSwitchCheckDefault" class="input form-check-input">
            <span class="slider"></span>
        </label>    

        <form role="search">
            <div class="container position-relative">
                <input id="searchInput" placeholder="Search..." required class="input" name="searchKey" type="text">
                <div class="icon text-primary">
                    <svg viewBox="0 0 512 512" class="ionicon" xmlns="http://www.w3.org/2000/svg">
                        <title>Search</title>
                        <path stroke-width="32" stroke-miterlimit="10" stroke="currentColor" fill="none"
                            d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z"></path>
                        <path d="M338.29 338.29L448 448" stroke-width="32" stroke-miterlimit="10" stroke-linecap="round"
                            stroke="currentColor" fill="none"></path>
                    </svg>
                </div>

                <!-- ✅ Search Results Container (Updated Dynamically) -->
                <div id="searchResults" class="dropdown-menu w-100 mt-2 shadow"></div>
            </div>
        </form>



        <a class="navbar-brand fw-semibold text-light ms-lg-5" href="#">
            <img src="{{ asset('images/logo_dark.png') }}" style="width: 60px;">
        </a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mx-lg-auto mb-2 mb-lg-0 ms-0">
                @switch(Auth::check())
                    @case(true)
                        @if(Auth::user()->role === 'admin')
                            <!-- ✅ Show Admin Message Instead of Navbar Links -->
                            <li class="nav-item">
                                <span class="nav-link text-warning fw-semibold">You are logged in as Admin</span>
                            </li>
                        @else
                            <!-- ✅ Show standard navbar links for normal users -->
                            <li class="nav-item"><a class="nav-link" href="{{ route('user#home') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('saved#list') }}">Saved</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('feedback#form') }}">Feedback</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('user#postHome') }}">Create Post</a></li>
                        @endif
                        @break

                    @default
                        <!-- ✅ Guest Mode Display with Login Button -->
                        <li class="nav-item ms-auto d-flex align-items-center">
                            <span class="nav-link text-warning fw-semibold">Guest Mode</span>
                        </li>
                @endswitch
            </ul>

            @if(Auth::check())
            <div class="dropdown">
                <button class="btn btn-outline-light d-flex align-items-center rounded-pill px-3 py-2" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- Profile Image -->
                    <div class="profile-img-container me-2">
                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                             alt="Profile" class="rounded-circle profile-img">
                    </div>
                    <span class="fw-semibold">{{ Auth::user()->name }}</span>
                    <i class="fa-solid fa-chevron-down ms-2"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="profileDropdown">
                    <li>
                        <div class="dropdown-header text-center">
                            <div class="profile-dropdown-img">
                                <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                     alt="Profile" class="rounded-circle">
                            </div>
                            <p class="fw-semibold mt-2 mb-1">{{ Auth::user()->name }}</p>
                            <small class="text-muted">{{ Auth::user()->email }}</small>

                            @if(Auth::user()->role === 'admin')
                                <p class="text-danger mt-1"><i class="fa-solid fa-shield-halved me-1"></i> Admin Mode</p>
                            @endif
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>

                    @if(Auth::user()->role === 'admin')
                        <!-- ✅ Show Dashboard Link for Admins -->
                        <li><a class="dropdown-item" href="{{ url('/admin/home') }}"><i class="fa-solid fa-tachometer-alt me-2"></i> Dashboard</a></li>
                    @else
                        <!-- ✅ Show Profile & Change Password for Regular Users -->
                        <li><a class="dropdown-item" href="{{ route('user#informationPage') }}"><i class="fa-solid fa-user-circle me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('user#changePasswordPage') }}"><i class="fa-solid fa-key me-2"></i> Change Password</a></li>
                    @endif

                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="button" class="dropdown-item text-danger fw-semibold" onclick="confirmLogout()">
                                <i class="fa-solid fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <!-- ✅ Guest Mode with Login Button (Aligned Right) -->
            <div class="d-flex align-items-center ms-auto">
                <i class="fa-solid fa-user text-white"></i>
                <a href="{{ route('login') }}" class="btn btn-primary ms-2">Login</a>
            </div>
        @endif


        </div>
    </div>
</nav>

<style>
    /* Profile Image in Navbar */
    .profile-img-container {
        width: 35px;
        height: 35px;
        overflow: hidden;
        border-radius: 50%;
    }

    /* Profile Image in Dropdown */
    .profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    /* Profile Dropdown Button */
    #profileDropdown {
        transition: all 0.3s ease-in-out;
    }

    #profileDropdown:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    /* Dropdown Menu Customization */
    .dropdown-menu {
        min-width: 220px;
        border-radius: 10px;
    }

    /* Dropdown Items Hover */
    .dropdown-item:hover {
        background-color: #f8f9fa;
        border-radius: 5px;
    }

    /* Profile Section in Dropdown */
    .dropdown-header {
        padding: 15px;
        text-align: center;
        background: #f8f9fa;
        border-radius: 10px 10px 0 0;
    }

    .profile-dropdown-img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto;
    }

    .profile-dropdown-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout() {
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
                document.getElementById('logoutForm').submit();
            }
        });
    }


    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let searchKey = $(this).val();

            if (searchKey.length > 1) {
                $.ajax({
                    url: "{{ route('user#home') }}",
                    type: "GET",
                    data: { searchKey: searchKey },
                    success: function(response) {
                        let resultsContainer = $("#searchResults");
                        resultsContainer.empty();

                        if (response.length > 0) {
                            response.forEach(post => {
                                resultsContainer.append(`
                                    <a href="/user/view/${post.id}" class="dropdown-item">
                                        <strong>${post.topic_name}</strong> - ${post.desc.substring(0, 50)}...
                                    </a>
                                `);
                            });
                        } else {
                            resultsContainer.append('<div class="dropdown-item text-muted">No results found</div>');
                        }

                        resultsContainer.show();
                    }
                });
            } else {
                $("#searchResults").hide();
            }
        });

        // Hide search results when clicking outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#searchInput, #searchResults').length) {
                $("#searchResults").hide();
            }
        });
    });
</script>

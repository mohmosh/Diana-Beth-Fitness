<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo"
                                    style="width: 150px; height: 150px; margin-left: 2px;">
                            </a>
                        </div>
                    </div>

                    <!-- Navbar -->
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="{{ url('/') }}">Home</a></li>
                                        <li><a href="{{ route('aboutUs.index') }}">About Us</a></li>
                                        <li><a href="{{ route('user.videos.index') }}">{{ auth()->check() ? 'Workouts' : 'Plans' }}</a></li>
                                        <li><a href="{{ route('user.devotionals.index') }}">Devotionals</a></li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Community
                                            </a>
                                            <ul class="dropdown-menu bg-dark">
                                                <li><a class="dropdown-item text-purple w-100" href="{{ route('videos.challenges') }}">Challenges</a></li>
                                                <li><a class="dropdown-item text-purple w-100" href="{{ route('testimonials.index') }}">Testimonials</a></li>
                                                <li><a class="dropdown-item text-purple w-100" href="{{ route('posts.index') }}">Forums</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                            <!-- Guest Users -->
                            @guest
                            <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                <a class="btn header-btn ms-2" href="{{ url('/register') }}">Register</a>
                            </div>
                            <div class="header-right-btn f-right d-none d-lg-block ml-15">
                                <a class="btn header-btn ms-2" href="{{ url('/login') }}">Login</a>
                            </div>
                            @endguest

                            <!-- Logged-in Users -->
                            @auth
                            <div class="header-right-btn f-right d-none d-lg-block ml-15">
                                <div class="dropdown">
                                    @php
                                    $defaultAvatar = asset('assets/img/avatar.jpeg');

                                    // Use timestamp to force image refresh
                                    $profilePicture = auth()->user()->profile_picture
                                    ? asset('storage/profile_pictures/' . auth()->user()->profile_picture) . '?' . time()
                                    : $defaultAvatar;
                                    @endphp

                                    <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="userProfileDropdown"
                                        data-bs-toggle="dropdown" aria-expanded="false">

                                        <img id="userAvatar" src="{{ $profilePicture }}"
                                            onerror="this.onerror=null; this.src='{{ $defaultAvatar }}';"
                                            alt="User Profile" class="profile-avatar">

                                        <span class="user-name">{{ auth()->user()->name }}</span>

                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userProfileDropdown">
                                        <li class="dropdown-item text-center">
                                            <strong>{{ auth()->user()->name }}</strong>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <!-- Profile Link -->
                                        <li>
                                            <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>
                                        </li>

                                        <!-- Admin Link -->
                                        @if(auth()->user()?->role_id == 1)
                                        <li>
                                            <a href="{{ route('adminTwo.dashboard') }}" class="dropdown-item" target="_blank">View as Admin</a>
                                        </li>
                                        @endif

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>


                                        <!-- Logout Button -->
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endauth






                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">


@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('profilePictureInput').addEventListener('change', function() {
            document.getElementById('profileForm').submit();
        });

        // Refresh page after a successful update to reflect new image
        if (window.location.href.includes('success')) {
            setTimeout(() => {
                location.reload();
            }, 1000);
        }
    });

    document.querySelector('input[name="profile_picture"]').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('userAvatar').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>



@endpush

@push('styles')
<style>
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ddd;
        transition: all 0.3s ease-in-out;
    }

    .profile-avatar:hover {
        transform: scale(1.1);
    }

    .profile-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ddd;
        margin-bottom: 8px;
    }

    .change-profile-link {
        display: block;
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
        margin-top: 5px;
    }

    .change-profile-link:hover {
        text-decoration: underline;
        color: #0056b3;
    }

    .user-name {
        font-size: 24px;
        /* Increase the font size */
        font-family: 'Poppins', sans-serif;
        /* Cool modern font */
        font-weight: bold;
        /* Make it bold */
        text-decoration: none;
        /* Remove underline */
        color: whitesmoke;
        /* Optional: Stylish color */
    }
</style>
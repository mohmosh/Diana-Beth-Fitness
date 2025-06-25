<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header header-sticky py-2" style="background-color: rgba(0, 0, 0, 0.85);">
            <div class="container-fluid px-4">
                <div class="row align-items-center justify-content-between">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6 d-flex align-items-center">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo"
                                style="max-height: 80px; width: auto;">
                        </a>
                    </div>

                    <!-- Navbar -->
                    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-8 col-6 d-flex justify-content-end align-items-center">
                        <nav class="main-menu d-none d-lg-block">
                            <ul id="navigation" class="d-flex gap-4 align-items-center mb-0">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ route('aboutUs.index') }}">About Us</a></li>
                                <li><a href="{{ route('user.videos.index') }}">{{ auth()->check() ? 'Workouts' : 'Plans' }}</a></li>
                                <li><a href="{{ route('user.devotionals.index') }}">Devotionals</a></li>
                                <li class="dropdown">
                                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">Community</a>
                                    <ul class="dropdown-menu bg-dark">
                                        <li><a class="dropdown-item text-light" href="{{ route('videos.challenges') }}">Challenges</a></li>
                                        <li><a class="dropdown-item text-light" href="{{ route('testimonials.index') }}">Testimonials</a></li>
                                        <li><a class="dropdown-item text-light" href="{{ route('posts.index') }}">Forums</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>

                        <!-- Auth Buttons -->
                        @guest
                        <div class="d-none d-lg-block ms-3">
                            <a class="btn btn-outline-light me-2" href="{{ url('/register') }}">Register</a>
                            <a class="btn btn-primary" href="{{ url('/login') }}">Login</a>
                        </div>
                        @endguest

                        @auth
                        <div class="dropdown ms-3">
                            @php
                                $defaultAvatar = asset('assets/img/avatar.jpeg');
                                $profilePicture = auth()->user()->profile_picture
                                    ? asset('storage/profile_pictures/' . auth()->user()->profile_picture) . '?' . time()
                                    : $defaultAvatar;
                            @endphp
                            <a class="dropdown-toggle d-flex align-items-center" href="#" role="button"
                                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ $profilePicture }}"
                                     alt="User" class="profile-avatar me-2"
                                     onerror="this.onerror=null;this.src='{{ $defaultAvatar }}';">
                                <span class="user-name">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end mt-2">
                                <li class="dropdown-item text-center fw-bold">{{ auth()->user()->name }}</li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                @if(auth()->user()?->role_id == 1)
                                    <li><a class="dropdown-item" href="{{ route('adminTwo.dashboard') }}" target="_blank">View as Admin</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endauth
                    </div>

                    <!-- Mobile Menu Toggle -->
                    <div class="col-12 d-block d-lg-none mt-2">
                        <div class="mobile_menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

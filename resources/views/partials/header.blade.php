<header>
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="logo" style="text-align: left;">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo" style="width: 150px; height: 150px; margin-left: 2px;">
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
                                        <li><a href="{{ url('/about') }}">About Us</a></li>
                                        <li><a href="{{ route('user.videos.index') }}">Workouts</a></li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Community
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('testimonials.access') }}">Testimonials</a></li>
                                                <li><a class="dropdown-item" href="{{ route('forums.access') }}">Forums</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#contact">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>

                            <!-- Auth Buttons -->
                            @guest
                                <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                    <a class="btn header-btn ms-2" href="{{ url('/register') }}">Register</a>
                                </div>
                                <div class="header-right-btn f-right d-none d-lg-block ml-15">
                                    <a class="btn header-btn ms-2" href="{{ url('/login') }}">Login</a>
                                </div>
                            @else
                                <div class="header-right-btn f-right d-none d-lg-block ml-15">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn header-btn ms-2">Logout</button>
                                    </form>
                                </div>
                            @endguest
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

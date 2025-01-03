<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Diana Beth Fitness')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/1.jpg') }}">


</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-red">
        <div class="container">
            <!-- Brand Name -->
            <a class="navbar-brand text-purple" href="{{ url('/') }}">Diana Beth Fitness</a>

            <!-- Mobile Toggle Button (SlickNav) -->
            <button class="slicknav_btn" type="button">
                <span class="slicknav_icon-bar"></span>
                <span class="slicknav_icon-bar"></span>
                <span class="slicknav_icon-bar"></span>
            </button>

            <!-- Navbar Links (For desktop, will collapse on mobile) -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Public Links -->
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ url('/workouts') }}">Workouts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ url('/programs') }}">Programs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ url('/healthy-living') }}">Healthy Living</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ url('/contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ url('/community') }}">Community</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ url('/community') }}">Social Media</a>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="btn btn-outline-purple ms-2" href="{{ url('/register') }}">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-purple ms-2" href="{{ url('/login') }}">Login</a>
                        </li>
                    @else
                        <!-- Authenticated User Links -->
                        <li class="nav-item">
                            <a class="nav-link text-black" href="{{ url('/dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="{{ route('fitness.content') }}">Fitness Content</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link text-danger">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Diana Beth Fitness</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/workouts') }}">Workouts</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/programs') }}">Programs</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/healthy-living') }}">Healthy Living</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/community') }}">Community</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/community') }}">Social Media</a></li>

                    @guest
                        <li class="nav-item"><a class="btn btn-outline-primary ms-2" href="{{ url('/register') }}">Register</a></li>
                        <li class="nav-item"><a class="btn btn-primary ms-2" href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('fitness.content') }}">Fitness Content</a></li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link text-danger">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav> --}}

    <!-- Bootstrap JS and Popper.js (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script> --}}
</body>
</html>







<!-- resources/views/partials/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">Diana Beth Fitness</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="{{ url('/workouts') }}">Workouts</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/programs') }}">Programs</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/healthy-living') }}">Healthy Living</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/community') }}">Community</a></li>
            <li class="nav-item">
                <a href="{{ url('/register') }}" class="btn btn-outline-light">Register</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/login') }}" class="btn btn-outline-light">Login</a>
            </li>
        </ul>
    </div>
</nav>

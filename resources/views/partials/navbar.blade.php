<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">Diana Beth Fitness</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/workouts') }}">Workouts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/programs') }}">Programs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/healthy-living') }}">Healthy Living</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/contact') }}">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/community') }}">Community</a>
        </li>
        <!-- Conditionally show Register and Login buttons -->
        @guest
          <li class="nav-item">
            <a class="btn btn-outline-light" href="{{ url('/register') }}">Register</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-light" href="{{ url('/login') }}">Login</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

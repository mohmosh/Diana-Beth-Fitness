<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <!-- Brand Name -->
      <a class="navbar-brand" href="{{ url('/') }}">Diana Beth Fitness</a>

      <!-- Mobile Toggle Button -->
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Links -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <!-- Public Links -->
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
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/community') }}">Social Media</a>
          </li>

          <!-- Authentication Links -->
          @guest
            <li class="nav-item">
              <a class="btn btn-outline-primary ms-2" href="{{ url('/register') }}">Register</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ms-2" href="{{ url('/login') }}">Login</a>
            </li>
          @else
            <!-- Authenticated User Links -->
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('fitness.content') }}">Fitness Content</a>
            </li>
            {{-- Log out button --}}
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


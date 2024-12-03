<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Diana Beth Fitness')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        .dashboard {
            background: linear-gradient(135deg, #9b59b6, #8e44ad); /* Purple gradient */
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            color: white;
        }
        .card {
            background: rgba(255, 255, 255, 0.7); /* Semi-transparent background */
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 400px;
        }
        .card h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #4a148c;
        }
        .card p {
            color: #555;
        }
        .card a {
            margin-top: 15px;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            background-color: #8e44ad;
            color: white;
            font-weight: bold;
        }
        .card a:hover {
            background-color: #9b59b6;
        }
        /* Navigation Bar Styling */
        .navbar {
            background-color: #8e44ad;
            padding: 10px 20px;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: rgb(14, 13, 13);
            font-weight: bold;
        }
        .navbar-nav .nav-link:hover {
            color: #d2b4de;
        }
        .navbar-nav .btn {
            margin-left: 10px;
        }
    </style>
</head>
<body>

    <!-- Include the Navbar -->
    @include('partials.navbar')



    <!-- Welcome Dashboard -->
    <div class="dashboard">
        <div class="card">
            <h1>Welcome to Diana Beth Fitness</h1>
            <p>Your journey to a healthier lifestyle starts here!</p>
            {{-- <a href="{{ url('/register') }}" class="btn btn-primary">Register Now</a> <!-- Register button --> --}}
        </div>
    </div>

    <div class="container mt-5">
        @yield('content') <!-- Content will be injected here -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




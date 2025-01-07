<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Diana Beth Fitness')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <!-- Additional CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>
    <!-- Include Header -->
    @include('partials.header')

    <!-- Main Content -->
    <div class="content-container">
        @yield('content') <!-- Dynamic content -->
    </div>

    <!-- Footer -->
    <footer>
        @include('partials.footer')
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<style>
    body {
        background-color: white;
        margin: 0;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        min-height: 100vh;
    }

    .content-container {
        flex-grow: 1; /* Ensures the content takes up available space */
        padding-bottom: 20px; /* Optional: add some space at the bottom if needed */
    }

    footer {
        margin-top: auto;
        background-color: #333333;
    }

    .card {
        background: rgb(235, 223, 236);
        border-radius: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 70px;
        width: 800px;
        height: 600px;
    }

    .card h1 {
        font-size: 4rem;
        color: #333333;
        text-align: center;
    }

    .form-group label {
        color: #333333;
    }

    .btn-primary {
        width: 100%;
    }
</style>

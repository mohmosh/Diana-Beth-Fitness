<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devotionals</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Ensure the layout fills the entire page */
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        /* Header Style */
        .header {
            background-color: whitesmoke;
            padding: 30px 15px;
            color: white;
            border-radius: 5px;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 10;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Header Buttons */
        .header .btn {
            font-size: 1rem;
            padding: 15px 18px;
            border-radius: 5px;
            width: 150px;
        }

        .btn-primary {
            background-color: purple;
            border-color: whitesmoke;
        }

        .btn-danger {
            background-color: purple;
            border-color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }

        /* Main Content Style */
        .container {
            max-width: 800px;
            margin-top: 90px;
            background-color: rgba(249, 249, 249, 0.9); /* Slight transparency for overlay effect */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            height: calc(100vh - 90px);
            overflow-y: auto;
        }

        /* Header Text Styling */
        .text-uppercase {
            text-transform: uppercase;
            font-family: 'Montserrat', sans-serif;
            font-weight: bolder;
        }

        .underline {
            text-decoration: underline;
            font-weight: bolder;
        }

        .devotional-item {
            background-color: #b867b5;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
            margin-bottom: 20px;
        }

        .devotional-item:hover {
            background-color: #b867b5;
        }

        .devotional-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .devotional-content {
            font-size: 1.2rem;
            font-weight: bold;
            color: #555;
        }

        .no-devotionals {
            font-size: 1.25rem;
            color: #888;
        }

        .signature {
            font-size: 1rem;
            font-style: italic;
            color: #333;
            margin-top: 20px;
            text-align: right;
            /* Right-align the signature */
        }

        /* Footer styles */
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: purple;
            color: white;
            text-align: center;
            padding: 10px;
        }

        /* Footer spacing */
        .footer p {
            margin: 0;
        }

        /* Logo Style */
        .logo {
            width: 100px;
            /* Adjust size of the logo */
            height: auto;
        }

        /* Image Style for background */
        .body-image {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            object-fit: cover;
            z-index: -1; /* Ensure the image is in the background */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); /* Shadow effect */
        }
    </style>
</head>

<body>
    <!-- Body Image (background with shadow) -->
    {{-- <img src="{{ asset('assets/img/gallery/2.jpg') }}"> --}}

    <!-- Header Section with Logo, Back and Logout buttons -->
    <div class="header d-flex justify-content-between align-items-center">
        <!-- Logo at the left -->
        <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo" style="width: 80px; height: 80px; margin-left: 2px;">

        <!-- Right-aligned Back and Logout buttons -->
        <div class="d-flex align-items-center">
            <a href="javascript:history.back()" class="btn btn-primary mr-2">Back</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline-block">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container">

        @forelse ($devotionals as $devotional)
            <div class="devotional-item mb-4">
                <h2 class="devotional-title">{{ $devotional->title }}</h2>
                <p class="devotional-content">{{ $devotional->content }}</p>
            </div>

            <!-- Signature -->
            <div class="signature">
                <p>by Diana Beth</p>
            </div>

        @empty
            <p class="no-devotionals text-center">No devotionals available for your plan.</p>
        @endforelse
    </div>

    <!-- Footer (optional) -->
    <div class="footer">
        <p>© 2025 Diana Beth Fitness</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

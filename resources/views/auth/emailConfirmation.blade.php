

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        /* Global Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Background */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #2c022e, #8e44ad);
            padding: 20px;
        }

        /* Card Container */
        .confirmation-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 500px;
            width: 100%;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Success Icon */
        .icon-container {
            font-size: 60px;
            color: #28a745;
            margin-bottom: 15px;
        }

        /* Heading */
        h2 {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        /* Description */
        p {
            font-size: 18px;
            color: #555;
            margin-bottom: 20px;
        }

        /* Button */
        .btn-home {
            display: inline-block;
            padding: 12px 25px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            background: #8e44ad;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .btn-home:hover {
            background: #6d318a;
            transform: scale(1.05);
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <div class="confirmation-card">
        <div class="icon-container">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2>Registration Successful!</h2>
        <p>A verification email has been sent to your email address. Please check your inbox.</p>

        <a href="/" class="btn-home">Go to Home</a>
    </div>

</body>
</html>



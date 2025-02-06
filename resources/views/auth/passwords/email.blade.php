<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Diana Beth Fitness</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card">
            <h2 class="text-dark mb-4">Forgot Your Password?</h2>

            <!-- Success Message -->
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group text-left">
                    <label for="email" class="font-weight-bold">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control rounded-pill" placeholder="Enter your email" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-3">Send Password Reset Link</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-muted">Back to Login</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<style>
    body {
        background: purple;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
        max-width: 450px;
        width: 100%;
        background: #fff;
        padding: 25px;
        text-align: center;
    }
    .btn-primary {
        background-color: #6a11cb;
        border: none;
        border-radius: 25px;
        padding: 10px;
    }
    .btn-primary:hover {
        background-color: #4b0ca8;
    }
    .form-control {
        border-radius: 20px;
    }
</style>

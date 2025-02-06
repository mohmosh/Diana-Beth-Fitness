<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Diana Beth Fitness</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card">
            <h2 class="text-dark mb-4">Reset Your Password</h2>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group text-left">
                    <label for="email" class="font-weight-bold">Email Address</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $email ?? '') }}" required>
                    @if ($errors->has('email'))
                        <div class="text-danger small">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="form-group text-left">
                    <label for="password" class="font-weight-bold">New Password</label>
                    <input type="password" class="form-control" name="password" required>
                    @if ($errors->has('password'))
                        <div class="text-danger small">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <div class="form-group text-left">
                    <label for="password_confirmation" class="font-weight-bold">Confirm New Password</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                    @if ($errors->has('password_confirmation'))
                        <div class="text-danger small">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary  btn-block mt-3 ">Reset Password</button>
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
        background: linear-gradient(to right, purple, #46035a);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Arial', sans-serif;
    }
    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
        max-width: 450px;
        width: 100%;
        background: #fff;
        padding: 25px;
        text-align: center;
    }
    .btn-primary {
        background-color: purple;
        border: none;
        border-radius: 25px;
        padding: 10px;
        font-weight: bold;
    }
    .btn-primary:hover {
        background-color: #d6c3d8;
    }
    .form-control {
        border-radius: 20px;
    }

    .btn {
        color: whitesmoke;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diana Beth Fitness Program</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #8e44ad; /* Purple background */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
        }
        .card h1 {
            font-size: 2.5rem;
            color: #333;
            text-align: center;
        }
        .form-group label {
            color: #333;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Register</h1>
        <form action="{{ url('register') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" id="phone_number" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>

            <div class="mb-3">
                <label for="fitness_goal" class="form-label">Fitness Goal</label>
                <input type="text" class="form-control" name="fitness_goal" id="fitness_goal">
            </div>

            <div class="mb-3">
                <label for="preferences" class="form-label">Preferences</label>
                <input type="text" class="form-control" name="preferences" id="preferences">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                <input type="hidden" name="role_id"   value="2">
            </div>

            {{-- <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select class="form-control" name="role_id" id="role_id" required>
                    <option value="">Select Role</option>
                    <option value="2">User</option>
                    <option value="1">Admin</option>
                </select>
            </div> --}}

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>

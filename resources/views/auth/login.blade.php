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
    
<div class="container mt-5 d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card shadow-lg" style="width: 100%; max-width: 400px;">
        <h1 class="text-center mb-4">Login</h1>

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <!-- Display Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

        <!-- Forgot Password Link -->
        <div class="mt-3 text-center">
            <a href="{{ route('password.request') }}" class="btn btn-link" style="font-size: 14px;">Forgot your password?</a>
        </div>

        <!-- Link to Register if the user doesn't have an account -->
        <div class="mt-3 text-center" style="margin-top: -10px;">
            <p>Don't have an account? <a href="{{ url('/register') }}" class="btn btn-outline-secondary btn-sm" style="font-size: 12px; padding: 5px 15px;">Register Now</a></p>
        </div>
    </div>
</div>
</body>
























{{--
@extends('layouts.app')


@section('title', 'DBF Login')

@section('content')
<div class="container mt-5 d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card shadow-lg" style="width: 100%; max-width: 400px;">
        <h1 class="text-center mb-4">Login</h1>

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <!-- Display Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

        <!-- Forgot Password Link -->
        <div class="mt-3 text-center">
            <a href="{{ route('password.request') }}" class="btn btn-link" style="font-size: 14px;">Forgot your password?</a>
        </div>

        <!-- Link to Register if the user doesn't have an account -->
        <div class="mt-3 text-center" style="margin-top: -10px;">
            <p>Don't have an account? <a href="{{ url('/register') }}" class="btn btn-outline-secondary btn-sm" style="font-size: 12px; padding: 5px 15px;">Register Now</a></p>
        </div>
    </div>
</div>
@endsection --}}




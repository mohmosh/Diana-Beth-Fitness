@extends('layouts.app')

@section('title', 'Login')

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

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

        <!-- Link to Register if the user doesn't have an account -->
        <div class="mt-3 text-center" style="margin-top: -10px;">
            <p>Don't have an account? <a href="{{ url('/register') }}" class="btn btn-outline-secondary btn-sm" style="font-size: 12px; padding: 5px 15px;">Register Now</a></p>

        </div>
    </div>
</div>
@endsection


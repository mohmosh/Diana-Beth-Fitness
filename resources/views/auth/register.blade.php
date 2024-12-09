@extends('layouts.app')

@section('title', 'Register')

@section('content')
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
                <input type="hidden" name="role_id" value="2">
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection





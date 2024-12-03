@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="container mt-5">
    <h1>Reset Your Password</h1>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </div>
    </form>
</div>
@endsection

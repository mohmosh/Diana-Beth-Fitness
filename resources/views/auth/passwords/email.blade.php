@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="container mt-5">
    <h1>Reset Your Password</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
        </div>
    </form>
</div>
@endsection

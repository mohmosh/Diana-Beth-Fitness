@extends('layouts.app')

@section('title', 'DBF Reset Password')

@section('content')
<div class="container mt-5">
    <h1>Reset Your Password</h1>

    <!-- Display validation errors (if any) -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $email) }}" required>
            @if ($errors->has('email'))
                <div class="text-danger">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
            @if ($errors->has('password'))
                <div class="text-danger">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
            @if ($errors->has('password_confirmation'))
                <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </div>
    </form>
</div>
@endsection



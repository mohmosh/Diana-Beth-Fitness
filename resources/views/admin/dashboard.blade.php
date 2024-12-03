@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <ul>
        <li><a href="{{ route('admin.dashboard') }}">View All Users</a></li>

        {{-- <li><a href="{{ route('admin.users') }}">View All Users</a></li> --}}
        {{-- <li><a href="{{ route('admin.addExercise') }}">Add Exercise</a></li> --}}
    </ul>
</div>
@endsection

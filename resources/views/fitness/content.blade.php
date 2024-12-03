@extends('layouts.app')

@section('title', 'Fitness Content')

@section('content')
<div class="container mt-5">
    <h1>Welcome to Fitness Content</h1>
    <p>Explore workouts, programs, healthy living tips, and more!</p>
    <a href="{{ route('workouts') }}" class="btn btn-primary">Workouts</a>
    <a href="{{ route('programs') }}" class="btn btn-secondary">Programs</a>
</div>
@endsection


@extends('layouts.app')

@section('title', 'Workouts')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Workouts</h1>

    <div class="row">
        @foreach($workouts as $workout)
            <div class="col-md-4">
                <div class="workout-card">
                    <img src="{{ asset('assets/img/gallery/' . $workout->image) }}" alt="{{ $workout->title }}">
                    <h3>{{ $workout->title }}</h3>
                    <a href="{{ route('workouts.show', $workout->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

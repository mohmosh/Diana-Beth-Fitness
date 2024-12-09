{{-- @extends('welcome') --}}

@extends('layouts.app')



@section('content')
<div class="container">
    <h1>Welcome, {{ $user->name }}</h1>
    <p>Your subscription progress: {{ $progress }}%</p>

    @if($subscription)
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;"
                 aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                {{ $progress }}%
            </div>
        </div>
    @else
        <p>No active subscription. <a href="#">Subscribe now</a></p>
    @endif

   
@endsection



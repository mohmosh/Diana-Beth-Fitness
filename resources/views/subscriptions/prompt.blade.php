@extends('layouts.app')

@section('content')
    <h1>Subscribe to Access Content</h1>
    <p>You need to subscribe to view content. Choose a plan below:</p>
    <a href="{{ route('index') }}" class="btn btn-primary">View Plans</a>
@endsection

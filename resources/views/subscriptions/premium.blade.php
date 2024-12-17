@extends('layouts.app')

@section('content')
    <h1>Welcome, {{ $user->name }}</h1>
    <p>You are on the Premium Plan. Enjoy all our content and community access:</p>

    {{-- <h2>Videos</h2>
    <ul>
        @foreach ($videos as $video)
            <li>{{ $video->title }}</li>
        @endforeach
    </ul> --}}

    <h2>Community</h2>
    {{-- <a href="{{ route('testimonials.index') }}">Testimonials</a> | --}}
    {{-- <a href="{{ route('forums.index') }}">Forums</a> --}}
@endsection

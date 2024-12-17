@extends('layouts.app')

{{-- @include('layouts.app'); --}}

@section('content')
    <h1>Welcome, {{ $user->name }}</h1>
    <p>You are on the Basic Plan. You can view the following videos:</p>
{{--
    <ul>
        @foreach ($videos as $video)
            <li>{{ $video->title }}</li>
        @endforeach
    </ul> --}}

    <p>Want to access more content and community? <a href="{{ route('subscriptions.prompt') }}">Upgrade your plan</a>.</p>
@endsection


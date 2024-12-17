@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Devotionals</h1>
    <ul>
        @forelse ($devotionals as $devotional)
            <li>{{ $devotional->title }}</li>
        @empty
            <p>No devotionals available for your plan.</p>
        @endforelse
    </ul>
</div>
@endsection

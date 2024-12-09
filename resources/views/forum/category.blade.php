@extends('layouts.app')

@section('content')
<h1>{{ $category->name }}</h1>
<ul>
    @foreach($threads as $thread)
        <li><a href="{{ route('forum.thread', [$category, $thread]) }}">{{ $thread->title }}</a></li>
    @endforeach
</ul>
@endsection

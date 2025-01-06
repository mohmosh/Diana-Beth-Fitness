@extends('layouts.app')

@section('content')
    <h1>Forum</h1>
    @foreach ($posts as $post)
        <div>
            <h2><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h2>
            <p>{{ $post->content }}</p>
            <small>By {{ $post->user->name }}</small>
        </div>
    @endforeach
    {{ $posts->links() }}
@endsection

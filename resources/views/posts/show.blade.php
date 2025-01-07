@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <small>By {{ $post->user->name }}</small>

    <hr>
    <h2>Comments</h2>
    @foreach ($post->comments as $comment)
        <div>
            <p>{{ $comment->content }}</p>
            <small>By {{ $comment->user->name }} {{ $comment->created_at->diffForHumans() }}</small>
        </div>
    @endforeach

    @auth
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <textarea name="content" rows="5" cols="30" maxlength="100"  required></textarea>
            
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <br>
            <button class="comment_btn" type="submit">Add Comment</button>
        </form>
    @endauth
@endsection

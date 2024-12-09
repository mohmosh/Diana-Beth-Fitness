@extends('layouts.app')

@section('content')
<h1>{{ $thread->title }}</h1>
<ul>
    @foreach($posts as $post)
        <li>{{ $post->content }} - <strong>{{ $post->user->name }}</strong></li>
    @endforeach
</ul>

<form action="{{ route('forum.post.store', [$thread->category, $thread]) }}" method="POST">
    @csrf
    <textarea name="content" required></textarea>
    <button type="submit">Add Post</button>
</form>
@endsection

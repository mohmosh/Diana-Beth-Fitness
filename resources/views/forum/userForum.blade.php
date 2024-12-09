@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Forum</h1>
    <a href="{{ route('forum.create') }}" class="btn btn-success mb-3">Create New Post</a>
    @foreach($forums as $forum)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $forum->title }}</h5>
                <p class="card-text">{{ $forum->content }}</p>
                <a href="{{ route('forum.show', $forum->id) }}" class="btn btn-primary">View Discussion</a>
            </div>
        </div>
    @endforeach
    {{ $forums->links() }}
</div>
@endsection

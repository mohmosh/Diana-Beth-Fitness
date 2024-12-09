@extends('layouts.app')

@section('content')
<h1>Forum Categories</h1>
<ul>
    @foreach($categories as $category)
        <li><a href="{{ route('forum.category', $category) }}">{{ $category->name }}</a></li>
    @endforeach
</ul>
@endsection


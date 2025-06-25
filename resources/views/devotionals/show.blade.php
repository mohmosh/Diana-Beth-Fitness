@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 12%;">
        <h2>{{ $devotional->title }}</h2>
        <div class="devotional-content">
            {!! $devotional->document_content !!}
        </div>
    </div>


@endsection

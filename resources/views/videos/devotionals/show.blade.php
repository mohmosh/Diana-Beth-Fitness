@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 12%;">
        <div class="devotional-content">
            {!! $video->devotional_content !!}
        </div>
    </div>

@endsection

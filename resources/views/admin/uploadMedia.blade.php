@extends('layouts.app')

@section('content')
    <h1>Upload Media</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('admin.uploadMedia') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="media">Choose a file:</label>
        <input type="file" id="media" name="media" required>
        <button type="submit">Upload</button>
    </form>
@endsection



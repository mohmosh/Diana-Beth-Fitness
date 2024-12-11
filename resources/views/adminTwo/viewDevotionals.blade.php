@extends('adminTwo.dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">All Devotionals</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($devotionals as $devotional)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $devotional->title }}</td>
                    <td>{{ Str::limit($devotional->content, 50) }}</td>
                    <td>{{ $devotional->created_at->format('d M, Y') }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info">Edit</a>
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No devotionals available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="display-4 mb-4 text-purple text-center">Level Jump Requests</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Current Level</th>
                <th>Requested Level</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->current_level }}</td>
                    <td>{{ $user->next_level }}</td>
                    <td>
                        <form action="{{ route('admin.approveLevelJump', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('admin.rejectLevelJump', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

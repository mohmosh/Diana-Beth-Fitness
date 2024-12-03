@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Users</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Fitness Goal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->fitness_goal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

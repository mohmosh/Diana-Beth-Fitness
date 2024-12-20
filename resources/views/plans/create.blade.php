@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a New Subscription Plan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('plans.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Plan Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
        </div>

       

        <!-- Subscription Type Selection -->
        <div class="form-group">
            <label for="subscription_type">Subscription Type</label>
            <select id="subscription_type" name="subscription_type" class="form-control" required>
                <option value="personal_training">Personal Training</option>
                <option value="build_his_temple">Build His Temple</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Plan</button>
    </form>
</div>
@endsection

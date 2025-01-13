@extends('adminTwo.dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Edit Plan</h1>

    <!-- Display Errors -->
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Plan Form -->
    <form action="{{ route('admin.updatePlan', $plan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $plan->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea id="description" name="description" class="form-control" rows="5" required>{{ $plan->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price:</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ $plan->price }}" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Plan</button>
    </form>
</div>
@endsection

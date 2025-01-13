@extends('adminTwo.dashboard')

@section('content')
<main>
    <div class="container mt-4">
        <!-- Page Title -->
        <div class="text-center">
            <h1 class="display-4 mb-4 text-purple">Plans</h1>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Plans Section -->
        <div class="d-flex justify-content-center">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @forelse ($plans as $plan)
                    <div class="col">
                        <div class="widget p-4 shadow-lg rounded text-center bg-light mb-4" style="height: 300px;">
                            <h4 class="text-primary mb-3">{{ $plan->name }}</h4>
                            <p class="text-muted mb-4">{{ $plan->description }}</p>
                            <h5 class="text-success mb-4">${{ $plan->price }} / month</h5>

                            <div class="d-grid gap-2">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.editPlan', $plan->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.deletePlan', $plan->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this plan?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">No plans uploaded yet.</p>
                    <a href="{{ route('plans.create') }}" class="btn btn-primary mt-3">Upload Plans</a>
                @endforelse
            </div>
        </div>
    </div>
</main>
@endsection

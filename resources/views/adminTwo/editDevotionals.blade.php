@extends('adminTwo.dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Edit Devotional</h1>

    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.updateDevotional', $devotional->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $devotional->title }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea id="content" name="content" class="form-control" rows="5" required>{{ $devotional->content }}</textarea>
        </div>

        <div class="mb-3">
            <label for="plan_id" class="form-label">Plan:</label>
            <select id="plan_id" name="plan_id" class="form-control" required>
                @foreach ($plans as $plan)
                    <option value="{{ $plan->id }}" {{ $plan->id == $devotional->plan_id ? 'selected' : '' }}>{{ $plan->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="level_required" class="form-label">Level Required:</label>
            <input type="number" id="level_required" name="level_required" class="form-control" value="{{ $devotional->level_required }}" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

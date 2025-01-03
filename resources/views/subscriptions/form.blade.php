@extends('layouts.app')

@section('content')
<div class="container">
    @if(auth()->check() && auth()->user()->subscription == null)
        <h2>Subscribe to {{ $plan->name }}</h2>

        <form action="{{ route('subscriptions.store') }}" method="POST">
            @csrf
            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
            <button type="submit" class="btn btn-success">Subscribe</button>
        </form>
    @elseif(!auth()->check())
        <h2>Register and Subscribe to {{ $plan->name }}</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <!-- Registration Fields -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
                @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <input type="hidden" name="role_id" value="2">

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Re-enter Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <input type="hidden" name="plan_id" value="{{ $plan->id }}">

            <button type="submit" class="btn btn-success">Register and Subscribe</button>
        </form>

        @else
        <!-- If user is already subscribed, show the appropriate workouts based on subscription type -->
        <p>You are already subscribed to the {{ auth()->user()->subscription->plan->name }} plan.</p>

        @if(auth()->user()->subscription->plan->subscription_type == 'personal_training')
            <h3>Personal Training Workouts</h3>
            <!-- Fetch and display Personal Training videos -->
            @php
                $videos = \App\Models\Video::where('subscription_type', 'personal_training')->get();
            @endphp

            @foreach($videos as $video)
                <div class="video">
                    <h4>{{ $video->title }}</h4>
                    <p>{{ $video->description }}</p>
                    <!-- Add more video details if needed -->
                    <video width="320" height="240" controls>
                        <source src="{{ asset('videos/' . $video->file_name) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endforeach

        @elseif(auth()->user()->subscription->plan->subscription_type == 'build_his_temple')
            <h3>Build His Temple Workouts</h3>
            <!-- Fetch and display Build His Temple videos -->
            @php
                $videos = \App\Models\Video::where('subscription_type', 'build_his_temple')->get();
            @endphp

            @foreach($videos as $video)
                <div class="video">
                    <h4>{{ $video->title }}</h4>
                    <p>{{ $video->description }}</p>
                    <!-- Add more video details if needed -->
                    <video width="320" height="240" controls>
                        <source src="{{ asset('videos/' . $video->file_name) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endforeach

        @else
            <p>You do not have access to workouts for this plan.</p>
        @endif


    @endif

</div>
@endsection

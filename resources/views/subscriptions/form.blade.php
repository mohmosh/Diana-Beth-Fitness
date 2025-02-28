<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diana Beth Fitness</title>
    <!-- Import Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional Styles -->
</head>

<body>


    <div class="container">
        <!-- Cancel Button -->
        <button onclick="window.history.back();"
            style="position: absolute; top: 20px; right: 300px; background-color: white; color: black; border: 1px solid #ccc; padding: 10px 20px;">Cancel</button>

        @if (auth()->check() && auth()->user()->subscription == null)
            <div class="form-container">
                <h2>Subscribe to {{ $plan->name }}</h2>

                <!-- Paystack Subscription Form -->
                <form id="paystackForm" action="{{ route('paystack.pay') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                    <input type="hidden" name="amount" id="planAmount" value="{{ $plan->price * 100 }}">
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                    <button type="submit" class="btn btn-success">Subscribe with Paystack</button>
                </form>



                {{-- <form action="{{ route('subscriptions.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                    <button type="submit" class="btn btn-success">Subscribe</button>
                </form> --}}


            </div>
        @elseif(!auth()->check())
            <div class="form-container">
                <h2>Register and Subscribe to {{ $plan->name }}</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <!-- Registration Fields -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone_number" class="form-control"
                            value="{{ old('phone_number') }}" required>
                        @error('phone')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="hidden" name="role_id" value="2">

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Re-enter Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" required>
                        @error('password_confirmation')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="hidden" name="plan_id" value="{{ $plan->id }}">

                    <button type="submit" class="btn btn-success">Register</button>
                </form>
            </div>
        @else
            <div class="container mt-5">
                <p>You are already subscribed to the {{ auth()->user()->subscription->plan->name }} plan.</p>

                @php
                    $subscriptionType = auth()->user()->subscription->plan->subscription_type;
                @endphp

                @if ($subscriptionType == 'build_his_temple')
                    <h3>Build His Temple Workouts</h3>
                    @php
                        $videos = \App\Models\Video::where('subscription_type', 'build_his_temple')->get();
                    @endphp

                    @if (auth()->user()->subscription->plan->subscription_type == 'free_trial')
                        @php
                            $trialStartDate = auth()->user()->trial_start_date;
                            $daysPassed = \Carbon\Carbon::parse($trialStartDate)->diffInDays(\Carbon\Carbon::now());
                        @endphp

                        @if ($daysPassed < 7)
                            <h3>Free Trial Workouts ({{ 7 - $daysPassed }} days left)</h3>
                            @php
                                $videos = \App\Models\Video::where('subscription_type', 'free_trial')->limit(7)->get();
                            @endphp
                        @else
                            <p>Your free trial has expired. Please subscribe to continue.</p>
                            @php $videos = collect(); @endphp
                        @endif
                    @endif
                @elseif($subscriptionType == 'challenge')
                    <h3>Challenges Workouts</h3>
                    @php
                        $videos = \App\Models\Video::where('subscription_type', 'challenge')->get();
                    @endphp
                @else
                    <p>You do not have access to workouts for this plan.</p>
                    @php $videos = collect(); @endphp
                @endif

                @foreach ($videos as $video)
                    <div class="video">
                        <h4>{{ $video->title }}</h4>
                        <p>{{ $video->description }}</p>
                        <video width="320" height="240" controls>
                            <source src="{{ asset('videos/' . $video->file_name) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endforeach


            </div>
        @endif
    </div>

    <!-- Import Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

<style>
    body {
        background-color: purple;
    }

    .container {
        margin-top: 200px;
    }

    .form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .btn-success {
        width: 100%;
        padding: 10px;
        background-color: purple;
    }

    .form-group label {
        font-weight: bold;
    }

    .error-message {
        font-size: 0.875rem;
        color: #e74c3c;
    }

    .video {
        margin-bottom: 30px;
    }

    .video h4 {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .signature {
        text-align: right;
        font-size: 0.9rem;
        color: #6a1b9a;
        font-style: italic;
    }
</style>

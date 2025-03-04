<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoProgress;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Unicodeveloper\Paystack\Facades\Paystack;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    public function index()
    {
        $personalTrainingPlans = Plan::where('subscription_type', 'personal_training')->get();

        $buildHisTemplePlans = Plan::where('subscription_type', 'build_his_temple')->get();

        $freeTrial = Plan::where('subscription_type', 'free_trial')->get();

        $challenges = Plan::where('subscription_type', 'challenge')->get();



        // merge both plans into one array
        $plans = $personalTrainingPlans->merge($buildHisTemplePlans)->merge($freeTrial)->merge($challenges);

        // Pass the merged plans to the view
        return view('subscriptions.index', compact('plans'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        // Check if the user is already logged in
        $user = Auth::user();

        // If the user is not logged in, handle new user registration
        if (!$user) {
            // If the user is not logged in, create a new user
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'required|string|max:15',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // Create the user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
            ]);

            // Automatically log in the new user
            Auth::login($user);
        }

        // Retrieve the plan
        $plan = Plan::find($request->plan_id);

        if (!$plan) {
            return redirect()->back()->with('error', 'The selected plan does not exist.');
        }

        // Create a subscription
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'subscription_type' => $plan->subscription_type,
            'start_date' => now(),
            'end_date' => now()->addMonths(1),
            'status' => 'active',
        ]);

        // Redirect based on plan type - appropriate dashboard
        if ($plan->subscription_type === 'personal_training') {

            // Redirect to Personal Training Dashboard
            return redirect()->route('videos.personalTraining')->with('success', 'You have successfully subscribed to the Personal Training plan.');
        } elseif ($plan->subscription_type === 'build_his_temple') {

            // Redirect to Build His Temple Dashboard
            return redirect()->route('videos.buildHisTemple')->with('success', 'You have successfully subscribed to the Build His Temple plan.');
        }

        // Fallback
        return redirect()->back()->with('error', 'There was an error processing your subscription. Please try again.');
    }






    public function showForm($planId)
    {
        // $user = Auth::user();

        // dd($user->subscription);

        $plan = Plan::findOrFail($planId);

        // dd($plan);

        return view('subscriptions.form', compact('plan'));
    }



    // public function pay(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'amount' => 'required|numeric|min:1',
    //         'plan_id' => 'required|exists:plans,id',
    //     ]);

    //     try {
    //         $data = [
    //             'email' => $request->email,
    //             'amount' => $request->amount * 100, // Paystack expects amount in kobo/cents
    //             'currency' => 'KES',
    //             'callback_url' => route('paystack.callback'),
    //             'metadata' => [
    //                 'plan_id' => $request->plan_id
    //             ]
    //         ];

    //         Log::info('Initializing Paystack Payment', $data);

    //         $payment = Paystack::getAuthorizationUrl($data)->redirectNow();

    //         return response()->json([
    //             'status' => 'success',
    //             'authorization_url' => $payment,
    //         ]);

    //     } catch (\Exception $e) {
    //         Log::error('Paystack Payment Error: ' . $e->getMessage());

    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Error initializing payment: ' . $e->getMessage()
    //         ], 400);
    //     }
    // }

    // public function handlePaystackCallback()
    // {
    //     $paymentDetails = Paystack::getPaymentData();

    //     if ($paymentDetails['status'] && $paymentDetails['data']['status'] == 'success') {
    //         $user = User::where('email', $paymentDetails['data']['customer']['email'])->first();

    //         if ($user) {
    //             Subscription::create([
    //                 'user_id' => $user->id,
    //                 'plan_id' => $paymentDetails['data']['metadata']['plan_id'] ?? null,
    //                 'status' => 'active',
    //                 'start_date' => now(),
    //                 'end_date' => now()->addMonth(),
    //             ]);
    //         }

    //         return redirect()->route('dashboard')->with('success', 'Payment successful!');
    //     }

    //     return redirect()->route('subscriptions.index')->with('error', 'Payment failed. Please try again.');
    // }

    // public function webhook(Request $request)
    // {
    //     Log::info('Paystack Webhook:', $request->all());

    //     if ($request->event == 'charge.success') {
    //         $paymentDetails = $request->data;
    //         $reference = $paymentDetails['reference'];

    //         Log::info('Verifying transaction: ' . $reference);

    //         $paystackResponse = Http::withHeaders([
    //             'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
    //             'Content-Type' => 'application/json',
    //         ])->get("https://api.paystack.co/transaction/verify/" . $reference);

    //         $verification = $paystackResponse->json();

    //         if (!$verification['status']) {
    //             Log::error('Paystack Webhook Error: Payment verification failed', $verification);
    //             return response()->json(['status' => 'failed'], 200); // ✅ Return 200 to prevent retries
    //         }

    //         $user = User::where('email', $paymentDetails['customer']['email'])->first();

    //         if ($user) {
    //             Subscription::updateOrCreate(
    //                 ['user_id' => $user->id],
    //                 [
    //                     'plan_id' => $paymentDetails['metadata']['plan_id'] ?? null,
    //                     'status' => 'active',
    //                     'start_date' => now(),
    //                     'end_date' => now()->addMonth(),
    //                 ]
    //             );
    //         }
    //     }

    //     return response()->json(['status' => 'success'], 200); // ✅ Always return 200 OK
    // }
}






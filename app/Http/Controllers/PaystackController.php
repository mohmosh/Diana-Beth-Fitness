<?php

namespace App\Http\Controllers;

use App\Mail\PaymentConfirmationMail;
use App\Models\Plan;
use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Facades\Paystack;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class PaystackController extends Controller
{
    public function pay(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1',
            'plan_id' => 'required|exists:plans,id',
        ]);


        // dd($request->all());

        try {

            /* 
            {
                "email": "user@example.com",
                "amount": 10000,
                "currency": "KES",
                "channels": ["mobile_money"],
                "metadata": {
                    "custom_fields": [
                    {
                        "display_name": "Phone Number",
                        "variable_name": "phone",
                        "value": "254712345678"
                    }
                    ]
                }
            }           
            */


            $data = [
                'email' => $request->email,
                'amount' => 1,
                'currency' => 'KES',
                'channels' => ['mobile_money'],
                'callback_url' => route('paystack.callback'),
                'metadata' => [
                    'plan_id' => $request->plan_id
                ]
            ];


            Log::info('Initializing Paystack Payment', $data);
            // dd($data);

            // Get Paystack response
            $payment = Paystack::getAuthorizationUrl($data);

            dd("Hasapaa");



            if (!$payment) {
                return back()->with('error', 'Failed to generate Paystack authorization URL');
            }

            // Redirect the user to Paystack checkout page
            return redirect()->away($payment->url);
        } catch (\Exception $e) {
            dd($e);

            Log::error('Paystack Payment Error: ' . $e->getMessage());

            return back()->with('error', 'Error initializing payment: ' . $e->getMessage());
        }
    }

    public function handlePaystackCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        if (!$paymentDetails || !isset($paymentDetails['data']['status'])) {
            return redirect()->route('subscription.error')->with('error', 'Payment verification failed.');
        }

        if ($paymentDetails['data']['status'] == 'success') {
            $email = $paymentDetails['data']['customer']['email'];
            $amount = $paymentDetails['data']['amount'];
            $planId = $paymentDetails['data']['metadata']['plan_id'];

            $user = User::where('email', $email)->first();
            $plan = Plan::find($planId);

            if ($user && $plan) {
                // Create or update the subscription
                Subscription::updateOrCreate(
                    ['user_id' => $user->id],
                    ['plan_id' => $plan->id, 'status' => 'active']
                );

                // Send confirmation email with name, amount, plan, and date
                Mail::to($user->email)->send(new PaymentConfirmationMail($user, $plan, $amount));

                // Redirect based on the subscription plan
                if ($plan->name === 'Personal Training') {
                    return redirect()->route('videos.personalTraining')->with('success', 'Payment successful! Your personal training workouts are now unlocked.');
                } elseif ($plan->name === 'Build His Temple') {
                    return redirect()->route('videos.BuildHisTemple')->with('success', 'Payment successful! Your Build His Temple workouts are now unlocked.');
                } elseif ($plan->name === 'Testing Plan') {
                    return redirect()->route('videos.personalTraining')->with('success', 'Payment successful! Your Build His Temple workouts are now unlocked.');
                } else {
                    return redirect()->route('workouts.index')->with('success', 'Payment successful! Your workouts are now unlocked.');
                }
            }
        }

        return redirect()->route('subscription.error')->with('error', 'Payment not successful.');
    }

    
    public function webhook(Request $request)
    {
        Log::info('Paystack Webhook:', $request->all());

        if ($request->event == 'charge.success') {
            $paymentDetails = $request->data;
            $reference = $paymentDetails['reference'];

            Log::info('Verifying transaction: ' . $reference);

            $paystackResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
                'Content-Type' => 'application/json',
            ])->get("https://api.paystack.co/transaction/verify/" . $reference);

            $verification = $paystackResponse->json();

            if (!$verification['status']) {
                Log::error('Paystack Webhook Error: Payment verification failed', $verification);
                return response()->json(['status' => 'failed'], 200); // ✅ Return 200 to prevent retries
            }

            $user = User::where('email', $paymentDetails['customer']['email'])->first();

            if ($user) {
                Subscription::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'plan_id' => $paymentDetails['metadata']['plan_id'] ?? null,
                        'status' => 'active',
                        // 'start_date' => now(),
                        // 'end_date' => now()->addMonth(),
                    ]
                );
            }
        }

        return response()->json(['status' => 'success'], 200); // ✅ Always return 200 OK
    }



    public function sendStkPush(Request $request)
    {
        // dd(auth()->user()->phone_number);
        // dd($request->all());

        $validated = $request->validate([
            'email' => 'required|email',
            'amount' => 'required|numeric', // In KES
            // 'phone' => 'required|string'    // e.g. 254712345678
        ]);


        $phone = auth()->user()->phone_number;
        $phone =  (int) ("254" . substr($phone, 1));
        // dd($phone);
        $phone = '+254727136485';
        // dd($phone);


        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))->post('https://api.paystack.co/charge', [
            'email' => $validated['email'],
            'amount' => $validated['amount'] * 1, // Convert to kobo (Paystack's smallest unit)
            'currency' => 'KES',
            'mobile_money' => [
                'phone' => '+254727136485',
                'provider' => 'mpesa'
            ]
        ]);

        if ($response->successful()) {

            return redirect()->route('videos.buildHisTemple')->with('success', 'Check your phone to pay and access BHT content.');

            // return response()->json([
            //     'status' => true,
            //     'message' => 'STK Push sent. Awaiting customer action...',
            //     'data' => $response->json()
            // ]);
        }



        return redirect()->route('videos.buildHisTemple')->with('error', 'There was an error,please contact +254727136485 to resolve.');

        // return response()->json([
        //     'status' => true,
        //     'message' => 'STK Push sent. Awaiting customer action...',
        //     'data' => $response->json()
        // ]);


        return response()->json([
            'status' => false,
            'message' => 'STK Push failed',
            'errors' => $response->json()
        ], 400);
    }
}

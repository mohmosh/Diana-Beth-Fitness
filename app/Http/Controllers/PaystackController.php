<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Facades\Paystack;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaystackController extends Controller
{
    public function pay(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'amount' => 'required|numeric|min:1',
            'plan_id' => 'required|exists:plans,id',
        ]);

        try {
            $data = [
                'email' => $request->email,
                'amount' => $request->amount * 100,
                'currency' => 'KES',
                'callback_url' => route('paystack.callback'),
                'metadata' => [
                    'plan_id' => $request->plan_id
                ]
            ];

            Log::info('Initializing Paystack Payment', $data);

            $paystack = new \Unicodeveloper\Paystack\Paystack();
            $payment = $paystack->getAuthorizationUrl();

            return response()->json([
                'status' => 'success',
                'authorization_url' => $payment,
            ]);

        } catch (\Exception $e) {
            Log::error('Paystack Payment Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Error initializing payment: ' . $e->getMessage()
            ], 400);
        }
    }


    public function callback()
    {
        $paymentDetails = Paystack::getPaymentData();

        if ($paymentDetails['data']['status'] == 'success') {
            $user = User::where('email', $paymentDetails['data']['customer']['email'])->first();
            if ($user) {
                Subscription::create([
                    'user_id' => $user->id,
                    'plan_id' => $paymentDetails['data']['metadata']['plan_id'] ?? null,
                    'status' => 'active',
                    'expires_at' => now()->addMonth(),
                ]);
            }

            return redirect()->route('dashboard')->with('success', 'Payment successful!');
        }

        return redirect()->route('subscriptions.index')->with('error', 'Payment failed. Please try again.');
    }

    public function webhook(Request $request)
    {
        Log::info('Paystack Webhook:', $request->all());

        if ($request->event == 'charge.success') {
            $paymentDetails = $request->data;
            $reference = $paymentDetails['reference'];

            // Log the reference for debugging
            Log::info('Verifying transaction: ' . $reference);

            // Verify the transaction with Paystack
            $paystackResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
                'Content-Type' => 'application/json',
            ])->get("https://api.paystack.co/transaction/verify/" . $reference);

            $verification = $paystackResponse->json();

            if (!$verification['status']) {
                Log::error('Paystack Webhook Error: Payment verification failed', $verification);
                return response()->json(['error' => 'Payment verification failed'], 400);
            }

            $user = User::where('email', $paymentDetails['customer']['email'])->first();

            if ($user) {
                Subscription::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'plan_id' => $paymentDetails['metadata']['plan_id'] ?? null,
                        'status' => 'active',
                        'start_date' => now(),
                        'end_date' => now()->addMonth(), // Add subscription duration
                    ]
                );
            }
        }

        return response()->json(['status' => 'success']);
    }
}

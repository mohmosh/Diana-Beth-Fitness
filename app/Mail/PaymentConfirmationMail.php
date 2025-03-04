<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $plan;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $plan)
    {
        $this->user = $user;
        $this->plan = $plan;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Payment Confirmation - Diana Beth Fitness')
                    ->view('emails.payment_confirmation')
                    ->with([
                        'name' => $this->user->name,
                        'plan' => $this->plan->name,
                        'amount' => $this->plan->price,
                    ]);
    }
}


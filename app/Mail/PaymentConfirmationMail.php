<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Plan;
use Carbon\Carbon;

class PaymentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $plan;
    public $amount;
    public $datePaid;

    public function __construct(User $user, Plan $plan, $amount)
    {
        $this->user = $user;
        $this->plan = $plan;
        $this->amount = $amount;
        $this->datePaid = Carbon::now()->toFormattedDateString(); // Format the date
    }

    public function build()
    {
        return $this->subject('Payment Confirmation')
                    ->view('emails.payment_confirmation')
                    ->with([
                        'name' => $this->user->name,
                        'plan' => $this->plan->name,
                        'amount' => number_format($this->amount, 2) . ' KES',
                        'datePaid' => $this->datePaid,
                    ]);
    }
}



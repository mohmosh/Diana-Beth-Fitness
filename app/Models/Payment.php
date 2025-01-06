<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'amount',
        'currency',
        'payment_method',
        'transaction_id',
        'status',
        'paid_at'
    ];


    public function payment()
    {
        return $this->belongsTo(Subscription::class);

    }

    // public function payment
    // {
    //     return $this->belongsTo(User::class);

    // }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'subscription_type', 

        'start_date',
        'end_date',
        'status',
        'payment_id'
    ];


    //  Relationship with User

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with SubscriptionPlan



    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }


}

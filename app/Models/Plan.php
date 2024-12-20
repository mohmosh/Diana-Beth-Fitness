<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',

        'subscription_type',
        'current_level',
        'level_approval',
    ];


    //  Relationship with SubscriptionPlan



    // Relationship with Subscription

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }



   
}

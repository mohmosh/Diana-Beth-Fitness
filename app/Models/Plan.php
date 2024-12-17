<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price'];


    //  Relationship with SubscriptionPlan

    public function subscriptionPlans()
    {
        return $this->hasMany(SubscriptionPlan::class);
    }


    // Relationship with Subscription

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // Relationship with videos
    public function isBasic()
    {
        return $this->name === 'Basic';
    }

    public function isPremium()
    {
        return $this->name === 'Premium';
    }

    public function videoLimit()
    {
        return $this->isBasic() ? 5 : null; // Limit for Basic plan
    }
}

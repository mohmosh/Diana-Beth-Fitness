<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'plan_id'];


    //  Relationship with User

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with SubscriptionPlan

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function plans()
    {
        return $this->belongsTo(Plan::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'plan_id', 'name', 'description', 'price'];

    // /**
    //  * Relationship with Plan
    //  */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

}

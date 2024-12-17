<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'fitness_goal',
        'preferences',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationship between a role and a user

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function devotionals()
    {
        return $this->hasMany(Devotional::class, 'uploaded_by');
    }

    public function subscriptions()
    {
        return $this->hasOne(Subscription::class);
    }

    public function accessibleVideos()
    {
        return $this->belongsToMany(Video::class, 'user_videos');
    }
    public function videos()
    {
        return $this->hasMany(Workout::class);
    }

    public function accessibleWorkouts()
{
    return $this->hasMany(Workout::class)->where('subscription_plan_id', $this->subscription->plan->id);
}


    // public function accessibleWorkouts()
    // {
    //     $plan = $this->subscription->plan;

    //     if ($plan->isPremium()) {
    //         return Workout::all(); // All workouts for premium users
    //     }

    //     if ($plan->isSilver()) {
    //         return Workout::where('is_silver', true)->get(); // Silver plan users can see silver workouts
    //     }

    //     if ($plan->isBasic()) {
    //         return Workout::where('is_bronze', true)->get(); // Bronze plan users can see bronze workouts
    //     }

    //     return collect(); // No workouts if the user has no plan or unrecognized plan
    // }

}

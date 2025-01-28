<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


use Carbon\Carbon;


class User extends  Authenticatable  implements MustVerifyEmail
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
        'role_id',
        'on_trial',
        'trial_start_date',
        'trial_end_date'
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
    protected $dates = ['trial_started_at'];  

    // Relationship between a role and a user

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function devotionals()
    {
        return $this->hasMany(Devotional::class, 'uploaded_by');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'subscription_plan_id');
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function videos()
    {
    return $this->belongsToMany(Video::class)->withPivot('completed');
    }

    public function accessibleWorkouts()
    {
        return $this->hasMany(Workout::class)->where('subscription_plan_id', $this->subscription->plan->id);
    }

    public function hasSubscription($type)
    {
        return $this->subscription_type === $type;
    }

    public function canAccessLevel($level)
    {
        return $this->current_level >= $level || $this->level_approval;
    }
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function videoProgress()
    {
        return $this->hasMany(VideoProgress::class);
    }

    // Check if the trial is active
    public function isTrialActive()
    {
        if ($this->on_trial) {
            $trialEndsAt = Carbon::parse($this->trial_start_date)->addDays(7);
            return Carbon::now()->lessThanOrEqualTo($trialEndsAt);
        }
        return false;
    }

    // Get remaining days of the trial
    public function trialDaysRemaining()
    {
        if ($this->on_trial) {
            $trialEndsAt = Carbon::parse($this->trial_start_date)->addDays(7);
            return Carbon::now()->diffInDays($trialEndsAt, false);
        }
        return 0;
    }


}



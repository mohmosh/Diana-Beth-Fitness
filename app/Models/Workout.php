<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'video_path'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function isBronze()
    {
        return $this->is_bronze;
    }

    /**
     * Determine if the workout is for silver subscription.
     *
     * @return bool
     */
    public function isSilver()
    {
        return $this->is_silver;
    }

    /**
     * Determine if the workout is for gold subscription.
     *
     * @return bool
     */
    public function isGold()
    {
        return $this->is_gold;
    }


}

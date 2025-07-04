<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Video extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'path',
        'url',
        'subscription_plan',
        'url',
        'subscription_type',
        'plan_id',
        'level',
        'devotional_content',
        'devotional_file'
    ];

    public function Plan()
    {
        return $this->belongsTo(Plan::class, 'subscription_plan', 'name');
    }

    public function scopeForSubscription($query, $type)
    {
        return $query->where('subscription_type', $type);
    }


    public function scopeForPersonalTraining($query)
    {
        return $query->where('subscription_type', 'personal_training');
    }

    public function scopeForBuildHisTemple($query, $level)
    {
        return $query->where('subscription_type', 'build_his_temple')
            ->where('level', $level);
    }

    public function progress()
    {
        return $this->hasMany(VideoProgress::class);
    }


    public function scopeForLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    public function devotional()
    {
        return $this->hasOne(Devotional::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('watched')->withTimestamps();
    }

    // public function plan()
    // {
    //     return $this->belongsTo(Plan::class);
    // }


    /**
     * Register the media conversions.
     *
     * @return void
     */
    public function registerMediaConversions(?\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(320)
            ->height(240)
            ->nonQueued() // Ensures the conversion is performed immediately
            ->crop('crop-center', 320, 240); // Centers the crop on the video
    }
}

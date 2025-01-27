<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devotional extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'uploaded_by',
        'subscription_type',
        'level_required',
        'document_content',
        'video_id'

    ];

    
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}

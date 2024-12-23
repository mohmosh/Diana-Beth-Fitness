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
        'plan_id',
        'level_required'
    ];

    public function plan()
    {
    return $this->belongsTo(Plan::class);
    }
}

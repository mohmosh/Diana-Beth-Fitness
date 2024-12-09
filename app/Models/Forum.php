<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content'];

// Each comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // User has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}


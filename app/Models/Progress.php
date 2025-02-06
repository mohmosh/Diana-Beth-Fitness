<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{

    use HasFactory;


    protected $fillable = [
        'user_id',
        'starting_weight',
        'closing_weight',
        'progress_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

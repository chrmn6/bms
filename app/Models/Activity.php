<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $primaryKey = 'activity_id';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'date_time',
        'location',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


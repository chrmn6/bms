<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blotter extends Model
{
    protected $primaryKey = 'blotter_id';

    protected $fillable = [
        'resident_id',
        'user_id',
        'incident_type',
        'incident_date',
        'incident_time',
        'location',
        'description',
        'status',
        'image',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

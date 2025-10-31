<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function getFormattedIncidentDateAttribute()
    {
        return Carbon::parse($this->incident_date)->format('F j, Y');
    }

    public function getFormattedIncidentTimeAttribute()
    {
        return Carbon::parse($this->incident_time)->format('h:i A');
    }

    public function getDisplayIdAttribute()
    {
        return 'BLR-' . str_pad($this->resident_id, 4, '0', STR_PAD_LEFT);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Blotter extends Model
{
    use HasFactory;
    protected $primaryKey = 'blotter_id';

    protected $fillable = [
        'resident_id',
        'user_id',
        'respondent_name',
        'incident_type',
        'incident_date',
        'incident_time',
        'location',
        'description',
        'image',
        'status',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDisplayIdAttribute()
    {
        return 'BLR-' . str_pad($this->blotter_id, 6, '20250', STR_PAD_LEFT);
    }

    public function getFormattedIncidentDateAttribute()
    {
        return Carbon::parse($this->incident_date)->format('F j, Y');
    }

    public function getFormattedIncidentTimeAttribute()
    {
        return Carbon::parse($this->incident_time)->format('h:i A');
    }
}

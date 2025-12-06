<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class BlotterCase extends Model
{
    use HasFactory;

    protected $primaryKey = 'blotter_case_id';

    protected $fillable = [
        'blotter_id',
        'incident_type',
        'incident_date',
        'incident_time',
        'location',
        'description',
    ];

    public function blotter()
    {
        return $this->belongsTo(Blotter::class, 'blotter_id', 'blotter_id');
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

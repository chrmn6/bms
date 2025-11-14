<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clearance extends Model
{
    use HasFactory;
    protected $primaryKey = 'clearance_id';

    protected $fillable = [
        'user_id',
        'resident_id',
        'clearance_type',
        'purpose',
        'issued_date',
        'valid_until',
        'status',
        'remarks',
    ];

    protected $casts = [
        'issued_date' => 'date',
        'valid_until' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }

    public function getDisplayIdAttribute()
    {
        return 'CLR-' . str_pad($this->clearance_id, 6, '20250', STR_PAD_LEFT);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blotter extends Model
{
    use HasFactory;
    protected $primaryKey = 'blotter_id';

    protected $fillable = [
        'resident_id',
        'user_id',
        'respondent_name',
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

    public function case()
    {
        return $this->hasOne(BlotterCase::class, 'blotter_id', 'blotter_id');
    }

    public function getDisplayIdAttribute()
    {
        return 'BLR-' . str_pad($this->blotter_id, 6, '20250', STR_PAD_LEFT);
    }
}

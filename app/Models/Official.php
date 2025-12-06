<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Official extends Model
{
    use HasFactory;

    protected $primaryKey = 'official_id';

    protected $fillable = [
        'resident_id',
        'position',
        'status',
        'term_start',
        'term_end',
    ];

    protected $casts = [
        'term_start' => 'date',
        'term_end' => 'date',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }

    public function getDisplayIdAttribute()
    {
        return 'OFL-' . str_pad($this->official_id, 6, '20250', STR_PAD_LEFT);
    }
}

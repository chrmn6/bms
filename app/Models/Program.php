<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $primaryKey = 'program_id';

    protected $fillable = [
        'title',
        'description',
        'program_date',
        'location',
        'attendees_count',
        'status',
        'time',
    ];

    protected $casts = [
        'program_date' => 'date',
        'time' => 'datetime:H:i',
    ];

    public function activities()
    {
        return $this->hasMany(Activity::class, 'program_id', 'program_id');
    }

    public function residents()
    {
        return $this->belongsToMany(Resident::class, 'program_resident', 'program_id', 'resident_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResidentProfile extends Model
{
    use HasFactory;
    protected $table = 'resident_profiles';
    protected $primaryKey = 'resident_profile_id';

    protected $fillable = [
        'resident_id',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'image',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResidentProfile extends Model
{
    protected $table = 'residents_profile';
    protected $primaryKey = 'resident_profile_id';

    protected $fillable = [
        'resident_id',
        'civil_status',
        'citizenship',
        'occupation',
        'education',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $primaryKey = 'resident_id';

    protected $fillable = [
        'household_id',
        'user_id',
        'middle_name',
        'suffix',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'address',
    ];

    public function household()
    {
        return $this->belongsTo(Household::class, 'household_id', 'household_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne(ResidentProfile::class, 'resident_id', 'resident_id');
    }
}

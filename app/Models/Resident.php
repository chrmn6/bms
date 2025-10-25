<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $primaryKey = 'resident_id';

    protected $fillable = [
        'user_id',
        'household_id',
        'middle_name',
        'suffix',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne(ResidentProfile::class, 'resident_id', 'resident_id');
    }

    public function details()
    {
        return $this->hasOne(ResidentDetails::class, 'resident_id', 'resident_id');
    }

    public function household()
    {
        return $this->belongsTo(Household::class, 'household_id', 'household_id');
    }

    public function clearances()
    {
        return $this->hasMany(Clearance::class, 'resident_id', 'resident_id');
    }

    public function getFullNameAttribute()
    {
        if ($this->user) {
            return $this->user->first_name . ' ' . $this->user->last_name;
        }
        return 'Unknown Name';
    }
}

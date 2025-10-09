<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{

    protected $table = 'households';
    protected $primaryKey = 'household_id';
    protected $fillable = [
        'household_number',
    ];

    public function resident()
    {
        return $this->hasMany(Resident::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{

    protected $primaryKey = 'household_id';
    protected $fillable = [
        'household_number',
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Household extends Model
{
    use HasFactory;
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

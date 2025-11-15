<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentAttributes extends Model
{
    use HasFactory;

    protected $table = 'resident_attributes';
    protected $primaryKey = 'resident_attribute_id';

    protected $fillable = [
        'resident_id',
        'voter_status',
        'blood_type',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id', 'resident_id');
    }

}

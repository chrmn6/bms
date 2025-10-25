<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResidentDetails extends Model
{
    use HasFactory;
    
    protected $table = 'resident_details';
    protected $primaryKey = 'resident_detail_id';

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    protected $primaryKey = 'clearance_id';

    protected $fillable = [
        'user_id',
        'resident_id',
        'clearance_type',
        'purpose',
        'issued_date',
        'status',
        'amount_paid',
        'payment_status',
        'or_number',
        'remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}

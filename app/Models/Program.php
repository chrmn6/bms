<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProgramApplication;

class Program extends Model
{
    use HasFactory;
    protected $primaryKey = 'program_id';
    protected $fillable = [
        'title', 
        'description',
        'applicants_limit',
        'applicants_count',
        'application_start', 
        'application_end'
    ];

    protected $casts = [
        'application_start' => 'datetime',
        'application_end' => 'datetime',
    ];

    public function expense()
    {
        return $this->hasOne(ProgramExpense::class, 'program_id', 'program_id')->with('official.resident');
    }


    public function applicants()
    {
        return $this->hasMany(ProgramApplication::class, 'program_id');
    }
}

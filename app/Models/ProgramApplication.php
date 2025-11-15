<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramApplication extends Model
{
    protected $fillable = ['program_id','resident_id','proof_file','status','note'];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class, 'resident_id');
    }

    public function getDisplayIdAttribute()
    {
        return 'APL-' . str_pad($this->resident_id, 6, '20250', STR_PAD_LEFT);
    }
}

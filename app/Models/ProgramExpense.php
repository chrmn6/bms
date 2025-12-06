<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgramExpense extends Model
{
    use HasFactory;
    protected $primaryKey = 'expense_id';
    protected $fillable = [
        'program_id',
        'amount',
        'created_by',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function official()
    {
        return $this->belongsTo(Official::class, 'created_by', 'official_id')->with('resident');
    }
}

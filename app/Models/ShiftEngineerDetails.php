<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftEngineerDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'shift_engineer_id',
        'six_am_to_two_pm',
        'two_pm_to_ten_pm',
        'ten_pm_to_six_am',
        'date',
    ];

    protected $table = 'shift_engineer_details'; 

    public function shiftEngineer()
    {
        return $this->belongsTo(ShiftEngineer::class, 'shift_engineer_id');
    }
}

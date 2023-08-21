<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftEngineer extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_by',
        'shift_name',
        'year_month',
        'assign_users_id',
    ];

    protected $table = 'shift_engineers';

    public function addedBy()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }
}

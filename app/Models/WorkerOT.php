<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerOT extends Model
{
    use HasFactory;

    protected $table = 'worker_ots';

    protected $fillable = [
        'added_by',
        'user_id',
        'start_date_time',
        'end_date_time',
        'purpose',
        'status',
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

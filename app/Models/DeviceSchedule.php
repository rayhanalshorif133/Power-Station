<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'purpose',
        'time',
        'time_value',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }
}

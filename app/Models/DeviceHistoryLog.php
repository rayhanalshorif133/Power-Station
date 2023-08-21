<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceHistoryLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id', 'message', 'date_time'
    ];


    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

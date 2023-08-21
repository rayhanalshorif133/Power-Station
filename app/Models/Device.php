<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'added_by',
        'category_id',
        'area_id',
        'section_id',
        'main_device_id',
        'image',
        'tag_no',
        'current_status_id',
        'description',
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    
    public function deviceCategory()
    {
        return $this->belongsTo(DeviceCategory::class, 'category_id');
    }

    public function deviceArea()
    {
        return $this->belongsTo(DeviceArea::class, 'area_id');
    }

    public function deviceSection()
    {
        return $this->belongsTo(DeviceSection::class, 'section_id');
    }

    public function deviceMainDevice()
    {
        return $this->belongsTo(DeviceMainDevice::class, 'main_device_id');
    }

    public function deviceStatus()
    {
        return $this->belongsTo(DeviceStatus::class, 'current_status_id');
    }

    public function deviceSchedule()
    {
        return $this->hasMany(DeviceSchedule::class, 'device_id');
    }

     public function createDeviceHistoryLog($deviceId, $message)
    {
        $deviceHistoryLog = new DeviceHistoryLog();
        $deviceHistoryLog->device_id = $deviceId;
        $deviceHistoryLog->message = $message . ' -' . auth()->user()->name;
        $deviceHistoryLog->date_time = date('Y-m-d H:i:s');
        $deviceHistoryLog->save();
        return $deviceHistoryLog;
    }
}

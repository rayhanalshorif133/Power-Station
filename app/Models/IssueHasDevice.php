<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueHasDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'issues_id',
        'devices_id',
        'needed_status_id',
        'note',
        'work_permit_status',
    ];

    public function issues()
    {
        return $this->belongsTo(Issue::class, 'issues_id');
    }
    public function devices()
    {
        return $this->belongsTo(Device::class, 'devices_id');
    }
    public function neededStatus()
    {
        return $this->belongsTo(DeviceStatus::class, 'needed_status_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_by', 'name',
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

     protected $hidden = [
        "created_at", "updated_at",
    ];
}

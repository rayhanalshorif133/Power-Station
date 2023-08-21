<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_by', 'title', 'note', 'priority',
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}

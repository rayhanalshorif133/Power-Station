<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueHistoryLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'issues_id', 'user_id', 'message', 'date_time'
    ];


    public function issue()
    {
        return $this->belongsTo(Issue::class, 'issues_id');
    }

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

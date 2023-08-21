<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_by',
        'notice_no',
        'title',
        'file',
        'description',
        'is_published',
    ];

    protected $table = 'notices';

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}

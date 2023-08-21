<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_by', 'name', 'has_users'
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function getAssignUsers($id)
    {
        $department = Department::find($id);
        $userIds = explode(',', $department->has_users);
        $users = User::select('id','name','email','phone','designation','status')->whereIn('id', $userIds)->get();
        return $users;
    }
}

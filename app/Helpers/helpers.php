<?php

use Carbon\Carbon;
use App\Models\Department;
use App\Models\User;




function userByDepartmentId($departmentId)
{
    $department = Department::find($departmentId);
    $userIds = explode(',', $department->has_users);
    $users = User::select('id','name','email','phone','designation','status')->whereIn('id', $userIds)->get();
    return $users;
}
function departmentByUserID($userId)
{
    $departments = Department::all();
    $userDepartmentIds = [];
    foreach ($departments as $department) {
        $userIds = explode(',', $department->has_users);
        if (in_array($userId, $userIds)) {
            $userDepartmentIds[] = $department->name;
        }
    }
    return $userDepartmentIds;
}
function hasDepartmentUserIds()
{
    $userId = Auth::user()->id;
    $departments = Department::all();
    $userDepartmentIds = [];
    foreach ($departments as $department) {
        $userIds = explode(',', $department->has_users);
        if (in_array($userId, $userIds)) {
            $userDepartmentIds[] = $department->id;
        }
    }
    return $userDepartmentIds;
}
function department()
{
    $userId = Auth::user()->id;
    $departments = Department::select('id', 'name', 'has_users')->get();
    foreach ($departments as $department) {
        $userIds = explode(',', $department->has_users);
        if (in_array($userId, $userIds)) {
            return $department;
        }
    }
}
function departments()
{
    $userId = Auth::user()->id;
    $departments = Department::select('id', 'name', 'has_users')->get();
    $userDepartments = [];
    foreach ($departments as $department) {
        $userIds = explode(',', $department->has_users);
        if (in_array($userId, $userIds)) {
            $userDepartments[] = $department;
        }
    }
    return $userDepartments;
}

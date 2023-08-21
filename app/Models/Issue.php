<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_by',
        'department_id',
        'from_forwarded_department_id',
        'forwarded_department_id',
        'collaboration_department',
        'issue_id',
        'title',
        'image',
        'description',
        'seriousness',
        'recommendation',
        // Status
        'status',
        'forwarded_status',
        'collaboration_status',
        'work_permit_status',
        // Just Note
        'note',
        'note_edit_by',
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    public function noteEditBy()
    {
        return $this->belongsTo(User::class, 'note_edit_by');
    }
    public function departments($departmentIds)
    {
        $departmentIds = explode(",", $departmentIds);
        return Department::select('id', 'name')->whereIn('id', $departmentIds)->get();
    }
    public function getImplodeDepartments($departmentIds)
    {
        $departmentIds = explode(",", $departmentIds);
        return Department::select('id', 'name')->whereIn('id', $departmentIds)->get();
    }
    public function forwardedDepartment()
    {
        return $this->belongsTo(Department::class, 'forwarded_department_id');
    }

    public function issueHasDevices()
    {
        return $this->hasMany(IssueHasDevice::class, 'issues_id');
    }

    public function getIssueId()
    {
        $lastIssueId = Issue::select('issue_id')->orderBy('issue_id', 'desc')->first();
        if ($lastIssueId) {
            $issueId = $lastIssueId->issue_id + 1;
        } else {
            $issueId = 11111;
        }
        $issue = Issue::where('issue_id', $issueId)->first();
        if ($issue) {
            $issue->getIssueId();
        } else {
            return $issueId;
        }
    }

    public function forwardedDepartmentName($id)
    {
        $department = Department::find($id);
        if ($department) {
            return $department->name;
        } else {
            return "None";
        }
    }


    public function collaborationDepartment($ids)
    {
        $departments = Department::whereIn('id', $ids)->get();
        $departmentNames = [];
        foreach ($departments as $department) {
            $departmentNames[] = $department->name;
        }
        return implode(', ', $departmentNames);
    }


    public function createIssueHistoryLog($issueId, $message)
    {
        $issueHistoryLog = new IssueHistoryLog();
        $issueHistoryLog->issues_id = $issueId;
        $issueHistoryLog->user_id = auth()->user()->id;
        $issueHistoryLog->message = $message . ' -' . auth()->user()->name;
        $issueHistoryLog->date_time = date('Y-m-d H:i:s');
        $issueHistoryLog->save();
        return $issueHistoryLog;
    }

    public function getIssueHistoryLog()
    {
        return $this->hasMany(IssueHistoryLog::class, 'issue_id');
    }
}

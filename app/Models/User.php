<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'cover_image',
        'email',
        'phone',
        'designation',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function departments()
    {
        $userId = Auth::user()->id;
        $departments = Department::select('id', 'name')->get();
        $userDepartments = [];
        foreach ($departments as $department) {
            $userIds = explode(',', $department->has_users);
            if (in_array($userId, $userIds)) {
                $userDepartments[] = $department;
            }
        }
        return $userDepartments;
    }
    public function department()
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

    public function getRole()
    {

        $roleName = Auth::user()->roles[0]->name;
        if ($roleName == 'operation-user') {
            $roleName = 'Operation User';
        } else if ($roleName == 'manager') {
            $roleName = 'Manager';
        } else if ($roleName == 'deputy-manager') {
            $roleName = 'Deputy Manager';
        } else if ($roleName == 'admin') {
            $roleName = 'Admin';
        } else {
            $roleName = 'User';
        }
        return $roleName;
    }

    public function getApprovedOrRejectedIssue($userId, $status){
        $issueHistoryLogs = IssueHistoryLog::where('user_id', $userId)->get();
        $approvedOrRejectedIssues = [];
        foreach ($issueHistoryLogs as $issueHistoryLog) {
            $hasAccepted = str_contains($issueHistoryLog->message, $status);
            if ($hasAccepted) {
                $issue = Issue::select('id','title','image','description',
                'seriousness','recommendation','status',
                'forwarded_status','collaboration_status','work_permit_status','note','note_edit_by')
                ->where("id",$issueHistoryLog->issues_id)->first();
                $issue->forwarded_status = $status;
                $issue->message = $issueHistoryLog->message;
                $approvedOrRejectedIssues[] = $issue;
            }
        }
        if($approvedOrRejectedIssues){
            return $approvedOrRejectedIssues;
        }else{
            return 'No ' . $status . ' issue.';
        }
    }
    public function getNotcheckedIssue($userId){
            return 'Working on';

        $issueHistoryLogs = IssueHistoryLog::where('user_id', $userId)->get();
        $approvedOrRejectedIssues = [];
        foreach ($issueHistoryLogs as $issueHistoryLog) {
            $hasAccepted = str_contains($issueHistoryLog->message, "Not Checked");
            if ($hasAccepted) {
                $issue = Issue::select('id','title','image','description',
                'seriousness','recommendation','status',
                'forwarded_status','collaboration_status','work_permit_status','note','note_edit_by')
                ->where("id",$issueHistoryLog->issues_id)->first();
                $issue->forwarded_status = $status;
                $issue->message = $issueHistoryLog->message;
                $approvedOrRejectedIssues[] = $issue;
            }
        }
        if($approvedOrRejectedIssues){
            return $approvedOrRejectedIssues;
        }else{
            return 'No Approved Issue';
        }
    }
}

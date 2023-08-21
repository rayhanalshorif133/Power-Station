<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceStatus;
use App\Models\Device;
use App\Models\Recommendation;
use App\Models\Issue;

class DashboardController extends Controller
{
    public function index()
    {
        $devices = Device::select('name','current_status_id')->with('deviceStatus')->get();
        $deviceStatus = [];
        foreach($devices as $device){
            $deviceStatus[] = [
                'status' => $device->name . ' - ' . $device->deviceStatus->name,
            ];
        }
        $recommendations = Recommendation::select('title','note')->get();

        $issues = Issue::select('id','image', 'title','seriousness','status','forwarded_status','collaboration_status','work_permit_status')->where('added_by', auth()->user()->id)->get();
        
        foreach ($issues  as $key => $issue) {
            if($issue->forwarded_status){
                $issue->status = $issue->forwarded_status;
            }
            else if($issue->collaboration_status){
                $issue->status = $issue->collaboration_status;
            }
            else if($issue->work_permit_status){
                $issue->status = $issue->work_permit_status;
            }else{
                $issue->status = $issue->status;
            }
            unset($issue->forwarded_status);
            unset($issue->collaboration_status);
            unset($issue->work_permit_status);
        }

        $data = [
            'device_status' => $deviceStatus,
            'quotes' => $recommendations,
            'issue_create' => $issues->count(),
            'issue_pending' => $issues->where('status', 'pending')->count(),
            'issue_accepted' => $issues->where('status', 'accepted')->count(),
            'issue_cancel' => $issues->where('status', 'cancel')->count(),
            'issues' => $issues,

        ];
        return $this->respondWithSuccess("Successfully fetch dashboard data", $data);
    }
}

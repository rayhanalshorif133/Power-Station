<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Device;
use App\Models\Issue;
use App\Models\IssueHasDevice;
use App\Models\User;
use App\Models\IssueHistoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Exception;



class IssueController extends Controller
{
    public function fetchIssue($id = null)
    {

        $roleBaseIssues = [];
        $authUserRole = Auth::user()->roles[0]->name;

        if($id == null){
            $issues = Issue::select()
                ->with('addedBy', 'noteEditBy','issueHasDevices.devices', 'issueHasDevices.neededStatus')
                ->orderBy('id', 'desc')
                ->get();
                $fetchAllIssues = [];
                $devices = Device::all();
                if($issues){
                    foreach ($issues as $issue) {
                        $notAddedDevices = [];
                        $getIssue = $this->fetchSingleIssue($issue);
                        array_push($fetchAllIssues, $getIssue);
                        foreach ($devices as $device) {
                            $isAdded = false;
                            foreach ($issue->issueHasDevices as $issueHasDevice) {
                                if ($issueHasDevice->devices_id == $device->id) {
                                    $isAdded = true;
                                    break;
                                }
                            }
                            if (!$isAdded) {
                                $notAddedDevices[] = $device;
                            }
                        }
                        // array_push($fetchAllIssues, $notAddedDevices);
                    }
                    return $this->respondWithSuccess("All Issues", $fetchAllIssues);
                }

                

            }else{
                $issue = Issue::select()
                    ->where('id', $id)
                    ->with('addedBy','noteEditBy','issueHasDevices.devices', 'issueHasDevices.neededStatus')
                    ->first();
                if($issue){
                    $fetchSingleIssue = $this->fetchSingleIssue($issue);
                    return $this->respondWithSuccess("Just id",$fetchSingleIssue);
                }
            }
            return $this->respondWithError("Issue not found");
    }

    protected function fetchSingleIssue($issue){

        $issue->departments = $issue->getImplodeDepartments($issue->department_id);
        unset($issue['department_id']);
        $issue->addedBy = User::select('name')->where('id', $issue->added_by)->first()->name;
        unset($issue['added_by']);
        // forwarded departments maintains::Start
        if($issue->from_forwarded_department_id != null) {
            $issue->fromForwardedDepartment = Department::select('id','name')->where('id', $issue->from_forwarded_department_id)->first();
            unset($issue['from_forwarded_department_id']);
        }
        if($issue->forwarded_department_id != null) {
            $issue->forwardedDepartment = Department::select('id','name')->where('id', $issue->forwarded_department_id)->first();
            unset($issue['forwarded_department_id']);
        }
        if($issue->collaboration_department != null) {
            $issue->collaborationDepartment = $issue->getImplodeDepartments($issue->collaboration_department);
            unset($issue['collaboration_department']);
        }
        return $issue;
    }
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:issues',
            'department_id' => 'required|integer',
            'image' => 'required',
            'seriousness' => 'required|string',
            'recommendation' => 'required|string',
        ]);


        if ($validator->fails()) {
            return $this->respondWithError($validator->errors()->all());
        }

        
        $issue = new Issue();
        $issue->issue_id = $issue->getIssueId();
        $issue->title = $request->title;
        $issue->department_id = $request->department_id;
        
        if ($request->hasfile('image')) {
            $image = "issue_image" . Date('d_m_y_h_m_s') . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('IssueImage/', $image, 'public');
            $issue->image = 'storage/IssueImage/' . $image;
        }
        $issue->description = $request->description;
        $issue->seriousness = $request->seriousness;
        $issue->recommendation = $request->recommendation;
        $issue->added_by = auth()->user()->id;
        $issue->save();
        $issue->load('addedBy');
        $issue->department = Department::find($issue->department_id);
        $issue->createIssueHistoryLog($issue->id, 'Issue created by');
        return $this->respondWithSuccess('Issue created successfully', $issue);
    }

    public function addDevice(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'device_id' => 'required|integer',
            'needed_status_id' => "required|integer"
        ]);
        if ($validator->fails()) {
            return $this->respondWithError('Device and needed status id are required');
        }
        try {
            $issue = Issue::find($id);
            if(!$issue){
                return $this->respondWithError('Issue not found');
            }
            $findIssueHasDevice = IssueHasDevice::where('issues_id', $issue->id)
                ->where('devices_id', $request->device_id)
                ->first();
            if ($findIssueHasDevice) {
                return $this->respondWithError('This device is already added');
            } else {
                IssueHasDevice::create([
                    'issues_id' => $issue->id,
                    'devices_id' => $request->device_id,
                    'needed_status_id' => $request->needed_status_id,
                    'note' => $request->note
                ]);
                if ($request->note) {
                    $issue->note_edit_by = auth()->user()->id;
                    $issue->save();
                }
                $issue->createIssueHistoryLog($issue->id, 'Device assigned to issue by');
                $issue->load('addedBy', 'noteEditBy');
                $issue->hasDevice = Device::select('id','name')->where('id',$request->device_id)->first();
                unset($issue['created_at']);
                unset($issue['updated_at']);
                return $this->respondWithSuccess('Device added successfully', $issue);
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    public function updateDevice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'issueHasDeviceId' => 'required|integer',
            'editStatus' => 'required|string',
            'editDeviceId' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return $this->respondWithError('Update status and device id are required');
        }
        try {
            $issueHasDevice = IssueHasDevice::find($request->issueHasDeviceId);
            $issueHasDevice->status = $request->editStatus;
            $issueHasDevice->devices_id = $request->editDeviceId;
            $issueHasDevice->save();
            $issueHasDevice->load('devices');

            $issue = Issue::find($issueHasDevice->issues_id);
            $issue->createIssueHistoryLog($issue->id, 'Device edited by');
            return $this->respondWithSuccess('Issue with device created successfully', $issueHasDevice);
        } catch (Exception $e) {
            return $this->respondWithError('message', $e->getMessage());
        }
    }

    public function deleteDevice(Request $request,$id){
        $getIssueHasDevice = IssueHasDevice::where('issues_id',$id)->where('devices_id',$request->device_id)->first();
        if($getIssueHasDevice){
            $getIssueHasDevice->delete();
            $getIssueHasDevice = IssueHasDevice::where('issues_id',$id)->get();
            return $this->respondWithSuccess('Device deleted successfully',$getIssueHasDevice);
        }else{
            return $this->respondWithError('Device or issue are not found');
        }
    }

    // Work Permits
    public function addNoteWorkPermit(Request $request, $id)
    {
        try {
            $issue = Issue::select()->where('id', $id)->with('issueHasDevices')->first();
            foreach ($issue->issueHasDevices as $issueHasDevice) {
                $issueHasDevice->work_permit_status = 'pending';
                $issueHasDevice->save();
            }
            if ($request->note) {
                $issue->note = $request->note;
                $issue->note_edit_by = auth()->user()->id;
                $issue->save();
            }
            if ($issue->work_permit_status == null) {
                $issue->work_permit_status = 'pending';
                $issue->save();
                $issue->createIssueHistoryLog($issue->id, 'Work permit successfully sended by');
                return $this->respondWithSuccess("Work permit successfully sended", $issue);
            } else {
                return $this->respondWithError("Work permit already sended");
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

     public function workPermitStatusUpdate($id, $status)
    {
        try {
            $issue = Issue::find($id);

            $issueHasDevices = IssueHasDevice::where('issues_id', $issue->id)->get();
            if ($status == 'accepted') {
                foreach ($issueHasDevices as $issueHasDevice) {
                    $issueHasDevice->work_permit_status = "approved";
                    $issueHasDevice->save();
                    $device = Device::find($issueHasDevice->devices_id);
                    $device->current_status_id = $issueHasDevice->needed_status_id;
                    $device->save();
                }
            } else {
                foreach ($issueHasDevices as $issueHasDevice) {
                    $issueHasDevice->work_permit_status = "rejected";
                    $issueHasDevice->save();
                }
            }
            $issue->work_permit_status = null;
            $issue->save();
            $issue->createIssueHistoryLog($issue->id, 'Work Permission has been ' . $status . ' by');
            return $this->respondWithSuccess('Work permit status updated successfully', $issue);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    



    public function forwardedIssue(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'issue_id' => 'required|integer',
            "department_id" => "required|integer",
        ]);

        if ($validator->fails()) {
            return $this->respondWithError('Issue and department are required');
        }else{
            
        try {
            $issue = Issue::find($request->issue_id);
            $issue->forwarded_department_id = $request->department_id;
            $issue->forwarded_status = 'pending';
            $authUserRole = Auth::user()->roles[0]->name;
            if($request->from_department_id){
                $issue->from_forwarded_department_id = $request->from_department_id;
            }else{
                $issue->from_forwarded_department_id = explode(",", $issue->department_id)[0];
            }
            $issue->save();
            $issue->createIssueHistoryLog($issue->id, 'Issue forwarded to ' . $issue->forwardedDepartment->name . ' department by');
            $issue->load('addedBy');
            return $this->respondWithSuccess('Issue forwarded successfully', $issue);
            } catch (Exception $e) {
                return $this->respondWithError('message', $e->getMessage());
            }
        }
    }
    public function forwardedStatusUpdate($id, $status)
    {
        try {
            $issue = Issue::find($id);
            if(!$issue){
                return $this->respondWithError('Issue not found');
            }
            $issue->forwarded_status = $status;
            if ($status == 'accepted') {
                $departmentIds = explode(",", $issue->department_id);
                foreach ($departmentIds as $departmentId) {
                    if ($departmentId == $issue->from_forwarded_department_id) {
                        $key = array_search($departmentId, $departmentIds);
                        unset($departmentIds[$key]);
                    }
                }
                $departmentIds[] = $issue->forwarded_department_id;
                $issue->department_id = implode(",", $departmentIds);
            }
            $issue->forwarded_department_id = null;
            $issue->from_forwarded_department_id = null;
            $issue->save();
            $issue->createIssueHistoryLog($issue->id, 'Issue forwarded ' . $status . ' by');
            return $this->respondWithSuccess('Issue forwarded status updated successfully', $issue);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    // collaboration issue
    public function collaborationIssue(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'issue_id' => 'required|integer',
            'departmentIds' => 'required|array',
        ]);

        
        if ($validator->fails()) {
            return $this->respondWithError('Issue and collaboration departments are required');
        }
        try {
            $issue = Issue::find($request->issue_id);
            
            if(!$issue){
                return $this->respondWithError('Issue not found');
            }
            
            $issue->collaboration_department = implode(",", $request->departmentIds);
            $issue->collaboration_status = 'pending';
            $issue->save();
            
            // collaborationDepartment
            $departmentNames = [];
            $issue->collaborationDepartments = Department::whereIn('id', $request->departmentIds)->get();
            foreach ($issue->collaborationDepartments as $collaborationDepartment) {
                $departmentNames[] = $collaborationDepartment->name;
            }
            $issue->createIssueHistoryLog($issue->id, 'Issue collaboration with ' . implode(",", $departmentNames) . ' department by');
            return $this->respondWithSuccess('Issue collaboration successfully', $issue);   
        } catch (Exception $e) {
            return $this->respondWithError('message', $e->getMessage());
        }
    }
    public function collaborationStatusUpdate($id, $status)
    {


        try {

            $issue = Issue::find($id);
            $authUserRole = Auth::user()->roles[0]->name;
            if ($authUserRole != 'admin') {
                $departments = explode(",", $issue->collaboration_department);
                foreach ($departments as $department) {
                    if (auth()->user()->department_id == $department) {
                        $key = array_search($department, $departments);
                        unset($departments[$key]);

                        $issue->department_id = auth()->user()->department_id;
                        $issue->save();

                        $departmentCollaborationIds = [];
                        array_push($departmentCollaborationIds, auth()->user()->department_id);
                        array_push($departmentCollaborationIds, $department);
                        $issue->department_id = implode(",", $departmentCollaborationIds);
                        $issue->save();
                    }
                }
                if ($departments) {
                    $issue->collaboration_department = implode(",", $departments);
                } else {
                    $issue->collaboration_department = null;
                    $issue->collaboration_status = null;
                }
            } else {
                $departmentCollaborationIds = [];
                if ($status == 'accepted') {
                    $departmentCollaborationIds = explode(",", $issue->collaboration_department);
                    $departmentCollaborationIds[] = $issue->department_id;
                    $issue->department_id = implode(",", $departmentCollaborationIds);
                }
                $departments = [];
                $issue->collaboration_department = null;
                $issue->collaboration_status = null;
            }
            $issue->save();
            $issue->createIssueHistoryLog($issue->id, 'Issue collaboration ' . $status . ' by');
            return $this->respondWithSuccess('Issue collaboration status updated successfully', $issue);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    // Issue Logs
    public function fetchIssueLogs($id = null)
    {
        if($id != null) {
            $issueLogs = IssueHistoryLog::where('issues_id', $id)->get();
        }else{
            $issueLogs = IssueHistoryLog::all();
        }
        return $this->respondWithSuccess('Issue logs', $issueLogs);
    }


    // Issue delete
    public function issueDestroy($id)
    {
        try {
            $issue = Issue::find($id);
            if($issue){
                $issue->delete();
                return $this->respondWithSuccess("Issue deleted successfully");
            }else{
                return $this->respondWithError("Issue not found");
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    // // Issue status fetch
    public function fetchIssueStatus($id = null)
    {

        $setIssueStatus = [];
        if($id != null) {
            $issueStatus = IssueHistoryLog::select()->where('issues_id', $id)->orderBy('id', 'asc')->get();
        }else{
            $issueStatus = IssueHistoryLog::select()->orderBy('id', 'asc')->get();
        }

        foreach ($issueStatus as $status) {
            $setIssueStatus[] = [
                'issue_id' => $status->issues_id,
                'issue_no' => $status->issue->issue_id,
                'status' => $this->customStatusFromMessage($status->message),
                'date_time' => $status->date_time,
            ];
        }

        return $this->respondWithSuccess('Successfully fetch Issue status', $setIssueStatus);
    }

    protected function customStatusFromMessage($message){
        $status = '';
        if(strpos($message, 'created') !== false){
            $status = 'created';
        }elseif(strpos($message, 'updated') !== false){
            $status = 'updated';
        }
        // forwarded issue status
        elseif(strpos($message, 'forwarded to') !== false){
            $status = 'forwarded pending';
        }
        elseif(strpos($message, 'Issue forwarded rejected') !== false){
            $status = 'forwarded rejected';
        }
        elseif(strpos($message, 'Issue forwarded accepted') !== false){
            $status = 'forwarded accepted';
        }

        // collaboration issue status
        elseif(strpos($message, 'collaboration rejected') !== false){
            $status = 'collaboration rejected';
        }
        elseif(strpos($message, 'Issue collaboration with') !== false){
            $status = 'collaboration pending';
        }
        elseif(strpos($message, 'Issue collaboration accepted') !== false){
            $status = 'collaboration accepted';
        }

        // added Device issue status
        elseif(strpos($message, 'Device assigned to') !== false){
            $status = 'device assigned';
        }
        elseif(strpos($message, 'Work permit successfully sended') !== false){
            $status = 'sending work permit';
        }
        elseif(strpos($message, 'Work Permission has been rejected') !== false){
            $status = 'work permit rejected';
        }
        elseif(strpos($message, 'Work Permission has been accepted') !== false){
            $status = 'work permit accepted';
        }
        elseif(strpos($message, 'accepted') !== false){
            $status = 'accepted';
        }
        elseif(strpos($message, 'rejected') !== false){
            $status = 'rejected';
        }elseif(strpos($message, 'closed') !== false){
            $status = 'closed';
        }elseif(strpos($message, 'reopened') !== false){
            $status = 'reopened';
        }elseif(strpos($message, 'deleted') !== false){
            $status = 'deleted';
        } 
        return $status ." by -". substr($message, strpos($message, "-") + 1);
    }
    
}

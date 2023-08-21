<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Device;
use App\Models\DeviceStatus;
use App\Models\Issue;
use App\Models\IssueHasDevice;
use App\Models\IssueHistoryLog;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;




class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::select()
            ->with('addedBy', 'noteEditBy')
            ->orderBy('id', 'desc')
            ->get();
        $roleBaseIssues = [];
        $authUserRole = Auth::user()->roles[0]->name;
        foreach ($issues as $issue) {
            $issue->departments = $issue->departments($issue->department_id);
            $issue->badge = "bg-" . $this->getRandomBadge();
            if ($authUserRole != 'admin') {
                foreach ($issue->departments as $department) {
                    if (in_array($department->id, Auth::hasDepartmentUserIds())) {
                        $roleBaseIssues[] = $issue;
                    }
                }
            }
        }
        if ($authUserRole != 'admin') {
            $issues = $roleBaseIssues;
        }
        $departments = Department::all();

        return view('issue.index', compact('issues', 'departments'));
    }

    public function forwardedListIndex()
    {
        $issues = Issue::select()
            ->with('addedBy')
            ->orderBy('id', 'desc')
            ->get();
        foreach ($issues as $issue) {
            $issue->departments = $issue->departments($issue->department_id);
            $issue->badge = "bg-" . $this->getRandomBadge();
            $issue->forwardedDepartments = $issue->departments($issue->forwarded_department_id);
        }
        $departments = Department::all();
        $authUserRole = Auth::user()->roles[0]->name;
        if ($authUserRole != 'admin') {
            $issues = $issues->where('forwarded_department_id', Auth::user()->department_id);
        }
        $issues = $issues->where('forwarded_status', 'pending');
        return view('issue.forwarded-list', compact('issues', 'departments'));
    }
    public function collaborationIndex()
    {
        $issues = Issue::select()
            ->where('collaboration_status', 'pending')
            ->with('addedBy')
            ->orderBy('id', 'desc')
            ->get();
        foreach ($issues as $issue) {
            $issue->departments = $issue->departments($issue->department_id);
            $issue->badge = "bg-" . $this->getRandomBadge();
            $issue->collaborationDepartments = $issue->departments($issue->collaboration_department);
        }

        $departmentIds = Auth::user()->department_id;
        $departments = Department::all();
        $authUserRole = Auth::user()->roles[0]->name;
        if ($authUserRole != 'admin') {
            $issues = $issues->whereIn('collaboration_department', $departmentIds);
        }
        return view('issue.collaboration-list', compact('issues', 'departments'));
    }

    public function logs()
    {

        $issueHistoryLogs = IssueHistoryLog::select()->with('issue')->orderBy('id', 'desc')->get();
        foreach ($issueHistoryLogs as $issueHistoryLog) {
            $dt = new DateTime($issueHistoryLog->date_time);
            $tz = new DateTimeZone('Asia/Dhaka'); // or whatever zone you're after
            $dt->setTimezone($tz);
            $issueHistoryLog->date_time = $dt->format('Y-m-d H:i:s');
            $issueHistoryLog->badge = "badge-soft-" . $this->getRandomBadge();
        }
        return view('issue.logs', compact('issueHistoryLogs'));
    }


    public function create()
    {
        return view('issue.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:issues',
            'department_id' => 'required',
            'image' => 'required',
            'seriousness' => 'required|string',
            'recommendation' => 'required|string',
        ]);

        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }
        try {
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
            $issue->createIssueHistoryLog($issue->id, 'Issue created by');
            Session::flash('message', 'Issue created successfully');
            Session::flash('class', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }
    }

    public function show($id)
    {
        $issue = Issue::select()
            ->where('id', $id)
            ->with('addedBy', 'issueHasDevices.devices', 'issueHasDevices.neededStatus')
            ->first();
        if (!$issue) {
            return redirect()->route('issue.index');
        }
        $devices = Device::all();
        $notAddedDevices = [];

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


        // collaborations
        if ($issue) {

            $issue->departments = $issue->departments($issue->department_id);
            // $issue->badge = "bg-" . $this->getRandomBadge();
            $departments = Department::all();
            $devicesStatuses = DeviceStatus::all();
            $departmentIds = explode(",", $issue->department_id);
            $departmentWithCollaborations  = Department::whereIn('id', $departmentIds)->get();
            foreach ($departmentWithCollaborations as $departmentWithCollaboration) {
                $departmentWithCollaboration->badge = "badge bg-" . $this->getRandomBadge();
            }
            $departmentIds = explode(",", $issue->collaboration_department);
            $collaborationDepartments = Department::whereIn('id', $departmentIds)->get();
            foreach ($collaborationDepartments as $collaborationDepartment) {
                $collaborationDepartment->badge = "badge bg-" . $this->getRandomBadge();
            }
            return view('issue.show', compact('issue', 'devices', 'departments', 'departmentWithCollaborations', 'collaborationDepartments', 'devicesStatuses', 'notAddedDevices'));
        } else {
            return redirect()->route('issue.index');
        }
    }
    // issue profile show in device logs
    public function profileShow($issueId){
        $issue = Issue::select()
            ->where('issue_id', $issueId)
            ->first();
        if (!$issue) {
            return $this->respondWithErrorWeb('Issue not found');
        }else{
            return $this->show($issue->id);
        }
    }



    public function update(Request $request){


        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:issues,title,' . $request->issue_id,
            'department_id' => 'required',
            'seriousness' => 'required|string',
            'recommendation' => 'required|string',
        ]);

        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }

        try {
            $issue = Issue::find($request->issue_id);
            $issue->title = $request->title;
            $departmentIds = implode(",", $request->department_id);
            $issue->department_id = $departmentIds;
            if ($request->hasfile('image')) {
                $image = str_replace("storage", "public", $issue->image);
                Storage::delete($image);
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
            $issue->createIssueHistoryLog($issue->id, 'Issue updated by');
            Session::flash('message', 'Issue successfully updated');
            Session::flash('class', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $issue = Issue::find($id);
        if ($issue) {
            $issue->delete();
            return $this->respondWithSuccess("Issue deleted successfully",[]);
        } else {
            return $this->respondWithError("Issue not found");
        }
    }

    public function fetch($id)
    {
        $issue = Issue::select()
            ->where('id', $id)
            ->with('addedBy', 'issueHasDevices.devices', 'issueHasDevices.neededStatus')
            ->first();

        $issue->departments = $issue->departments($issue->department_id);
        
        return $this->respondWithSuccess("Successfully fetch issue...",$issue);
    }


    public function fetchIssueDepartment($id)
    {
        $issue = Issue::findOrFail($id);
        $departments = explode(",", $issue->department_id);
        $departments = Department::select('id', 'name')->whereNotIn('id', $departments)->get();
        return $this->respondWithSuccess("Issue department fetched successfully", $departments);
    }
   
    public function fetchIssueInDepartment($id)
    {
        $issue = Issue::findOrFail($id);
        $departments = explode(",", $issue->department_id);
        $departments = Department::select('id', 'name')->whereIn('id', $departments)->get();
        return $this->respondWithSuccess("Issue department fetched successfully", $departments);
    }

    public function addDevice(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'device_id' => 'required|integer',
            "needed_status" => "required"
        ]);
        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }
        try {
            $issue = Issue::find($id);
            $findIssueHasDevice = IssueHasDevice::where('issues_id', $issue->id)
                ->where('devices_id', $request->device_id)
                ->first();
            if ($findIssueHasDevice) {
                Session::flash('message', 'Device already added');
                Session::flash('class', 'danger');
                return redirect()->back()->withInput();
            } else {
                IssueHasDevice::create([
                    'issues_id' => $issue->id,
                    'devices_id' => $request->device_id,
                    'needed_status_id' => $request->needed_status,
                    'note' => $request->note
                ]);
                if ($request->note) {
                    $issue->note_edit_by = auth()->user()->id;
                    $issue->save();
                }
                $device = Device::find($request->device_id);
                $device->createDeviceHistoryLog($device->id, 'Device is added pending request in this issue ('. $issue->issue_id .') by');
                $issue->createIssueHistoryLog($issue->id, 'Device assigned to issue by');
                Session::flash('message', 'Device added successfully');
                Session::flash('class', 'success');
                return redirect()->back();
            }
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }
    }

    public function editDevice(Request $request)
    {
        $issueHasDevice = IssueHasDevice::find($request->id);
        $issue = Issue::find($issueHasDevice->issues_id);
        $issueHasDevice->needed_status_id = $request->editStatus;
        $issueHasDevice->devices_id = $request->editDeviceId;
        $issueHasDevice->save();
        $issueHasDevice->load('devices', 'neededStatus');
        $device = Device::find($request->editDeviceId);
        $device->createDeviceHistoryLog($device->id, 'Device is added pending request in this issue ('. $issue->issue_id .') by');
        $issue->createIssueHistoryLog($issue->id, 'Device edited by');
        return $this->respondWithSuccess("Device has been successfully updated", $issueHasDevice);
    }


    public function deleteDevice($id)
    {
        $issueHasDevice = IssueHasDevice::find($id);
        $device = Device::find($issueHasDevice->devices_id);
        $issue = Issue::find($issueHasDevice->issues_id);
        $issueHasDevice->delete();
        $issue->createIssueHistoryLog($issue->id, 'Device deleted from this issue by');
        $device->createDeviceHistoryLog($device->id, 'Device is deleted in this issue ('. $issue->issue_id .') by');
        return $this->respondWithSuccess("Device has been successfully deleted", $issueHasDevice);
    }


    // forwarded issue
    public function forwardedIssue(Request $request)
    {
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
            return $this->respondWithSuccessWeb("Issue forwarded successfully");
        } catch (Exception $e) {
            return $this->respondWithErrorWeb($e->getMessage());
        }
    }

    public function forwardedStatusUpdate($id, $status)
    {
        try {
            $issue = Issue::find($id);
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
            Session::flash('message', 'Update issue forwarded status successfully');
            Session::flash('class', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }
    }
    // collaboration issue
    public function collaborationIssue(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'departmentIds' => 'required|array',
        ]);
        if ($validator->fails()) {
            Session::flash('message', "Please select at least one department");
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }



        try {
            $issue = Issue::find($request->issue_id);
            $issue->collaboration_department = implode(",", $request->departmentIds);
            $issue->collaboration_status = 'pending';
            $issue->save();
            // collaborationDepartment
            $departmentNames = [];
            $collaborationDepartments = Department::whereIn('id', $request->departmentIds)->get();
            foreach ($collaborationDepartments as $collaborationDepartment) {
                $departmentNames[] = $collaborationDepartment->name;
            }
            $issue->createIssueHistoryLog($issue->id, 'Issue collaboration with ' . implode(",", $departmentNames) . ' department by');
            Session::flash('message', 'Collaboration successfully done');
            Session::flash('class', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
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
            Session::flash('message', 'Update issue collaboration status successfully');
            Session::flash('class', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
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
                return $this->respondWithSuccessWeb("Work permit successfully sended");
            } else {
                return $this->respondWithErrorWeb("Work permit already sended");
            }
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect();
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
            Session::flash('message', 'Work Permission has been ' . $status . '.');
            Session::flash('class', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }
    }
    public function multiDelete(Request $request){
        $issues = Issue::whereIn('id',$request->ids)->get();
        foreach ($issues as $issue) {
            $issue->delete();
        }
        return $this->respondWithSuccess("Issues deleted successfully.");
    }
}

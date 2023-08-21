<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ShiftEngineer;
use App\Models\ShiftEngineerDetails;

class ShiftEngineerController extends Controller
{
    public function index()
    {
        $shiftEngineers = ShiftEngineer::select()->with('addedBy')->get();
        foreach ($shiftEngineers as $shiftEngineer) {
            $shiftEngineer->assignUsers = User::select('name')
                    ->whereIn('id',  explode(",", $shiftEngineer->assign_users_id))
                    ->get();
        }
        return view('shift_engineer.index', compact('shiftEngineers'));
    }
    public function create()
    {
        $users = User::all();
        return view('shift_engineer.create', compact('users'));
    }

    public function viewAndEdit($id){
        $shiftEngineer = ShiftEngineer::select()->with('addedBy')->where('id', $id)->first();
        $shiftEngineer->assignUsers = User::select('name')
                    ->whereIn('id',  explode(",", $shiftEngineer->assign_users_id))
                    ->get();
        $users = User::all();
        return view('shift_engineer.view_and_edit', compact('shiftEngineer', 'users'));
    }

    public function fetchUserName(Request $request)
    {
        $users = $request->assignUsers;
        $users = User::select('id','name')->whereIn('id', $users)->orderBy('id','asc')->get();
        return $this->respondWithSuccess("Fetch successfully user name data", $users);
    }

    public function store(Request $request){
        try {

            
            $shiftEngineer = new ShiftEngineer();
            $shiftEngineer->shift_name   = $request->shiftName;
            $shiftEngineer->year_month = $request->yearMonth;
            $shiftEngineer->added_by   = auth()->user()->id;
            $shiftEngineer->assign_users_id   = implode(',', $request->user_ids);
            $shiftEngineer->save();

            foreach ($request->shiftInfoDetails as $key => $shiftInfo) {
                $shiftEngineerDetail = new ShiftEngineerDetails();
                $shiftEngineerDetail->shift_engineer_id = $shiftEngineer->id;
                $shiftEngineerDetail->six_am_to_two_pm = $shiftInfo["sixAMToTwoPM"];
                $shiftEngineerDetail->two_pm_to_ten_pm = $shiftInfo["twoPMToTenPM"];
                $shiftEngineerDetail->ten_pm_to_six_am = $shiftInfo["tenPMToSixAM"];
                // date format
                $date = $shiftInfo["date"];
                $date = str_replace('/', '-', $date);
                $date = date('Y-m-d', strtotime($date));
                $shiftEngineerDetail->date = $date;
                $shiftEngineerDetail->save();
            }
            return $this->respondWithSuccess("Shift Engineer created successfully", $request->all());


        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

    }

    public function delete($id)
    {
        try {
            $shiftEngineer = ShiftEngineer::find($id);
            if($shiftEngineer){
                $shiftEngineer->delete();
                return $this->respondWithSuccess("Shift Engineer deleted successfully");
            }else{
                return $this->respondWithError("Shift Engineer not found");
            }
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}

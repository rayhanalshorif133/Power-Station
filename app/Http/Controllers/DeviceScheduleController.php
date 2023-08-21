<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DeviceScheduleController extends Controller
{
    public function index()
    {
        $devices = Device::select()
            ->with('deviceCategory','deviceSchedule')
            ->get();
        foreach ($devices as $device) {
            $device->images  = json_decode($device->image);
        }
        return view('device-schedule.index', compact('devices'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required|integer',
            'time' => 'required',
            'time_value' => 'required',
            'purpose' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }

        try {
            $deviceSchedule = new DeviceSchedule();
            $deviceSchedule->device_id = $request->device_id;
            $deviceSchedule->time = $request->time;
            $deviceSchedule->time_value = $request->time_value;
            $deviceSchedule->purpose = $request->purpose;
            $deviceSchedule->save();
            Session::flash('message', 'Device Schedule successfully created');
            Session::flash('class', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back();
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'deviceSchedule_id' => 'required|integer',
            'time' => 'required',
            'time_value' => 'required',
            'purpose' => 'required'
        ]);
        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }

        try{
            $deviceSchedule = DeviceSchedule::find($request->deviceSchedule_id);
            $deviceSchedule->time = $request->time;
            $deviceSchedule->time_value = $request->time_value;
            $deviceSchedule->purpose = $request->purpose;
            $deviceSchedule->save();
            Session::flash('message', 'Device Schedule successfully updated');
            Session::flash('class', 'success');
            return redirect()->back();
        }catch (Exception $e){
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back();
        }
    }

    public function delete($id){
        try{
            $deviceSchedule = DeviceSchedule::find($id);
            $deviceSchedule->delete();
            return $this->respondWithSuccess('Device Schedule successfully deleted');
        }catch (Exception $e){
            return $this->respondWithError($e->getMessage());
        }
    }
}

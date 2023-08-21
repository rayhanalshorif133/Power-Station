<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\DeviceSchedule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class DeviceScheduleController extends Controller
{

    public function fetch($id = null)
    {
        $devices = [];
        if($id){
            $devices = Device::select('id','name')->where('id',$id)->first();
            $deviceSchedules = DeviceSchedule::select('id','purpose','time','time_value')->where('device_id',$id)->get();
            $devices->component = $deviceSchedules;
        }else{
            $devices = Device::select('id','name')->get();
            foreach($devices as $device){
                $deviceSchedules = DeviceSchedule::select('id','purpose','time','time_value')->where('device_id',$device->id)->get();
                if($deviceSchedules->count() > 0){
                    $device->component = $deviceSchedules;
                }else{
                    $devices = $devices->except($device->id);
                }
            }
        }

        if($devices){
            return $this->respondWithSuccess("Successfully fetched device schedules", $devices);
        }else{
            return $this->respondWithError("Not found any device schedules");
        }
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'device_id' => 'required|integer',
            'time' => 'required',
            'time_value' => 'required',
            'purpose' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->respondWithError('Assign Device , Time or Purpose field are required or invalid.');
        }

        try {
            $deviceSchedule = new DeviceSchedule();
            $deviceSchedule->device_id = $request->device_id;
            $deviceSchedule->time = $request->time;
            $deviceSchedule->time_value = $request->time_value;
            $deviceSchedule->purpose = $request->purpose;
            $deviceSchedule->save();

            $deviceSchedule->device = Device::select('id', 'name')
                ->where('id', $request->device_id)
                ->get();
            foreach ($deviceSchedule->device as $device) {
                $deviceSchedule->device->images  = json_decode($device->image);
            }
            unset($deviceSchedule->device_id);
            unset($deviceSchedule->created_at);
            unset($deviceSchedule->updated_at);
            return $this->respondWithSuccess('Device Schedule successfully created', $deviceSchedule);
        } catch (\Exception $e) {
            return $this->respondWithError('Something went wrong', $e->getMessage());
        }
    }
}

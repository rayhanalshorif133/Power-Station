<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceStatus;
use Illuminate\Support\Facades\Validator;



class DeviceStatusController extends Controller
{
    public function fetchAll()
    {
        $mainDevices = DeviceStatus::select()->with('addedBy')->get();
        return $this->respondWithSuccess("Device status fetched successfully", $mainDevices);
    }
    public function fetch($id)
    {
        $mainDevice = DeviceStatus::select()->with('addedBy')->where('id', $id)->first();
        if($mainDevice){
            return $this->respondWithSuccess("Device status fetched successfully", $mainDevice);
        }else{
            return $this->respondWithError("Device status is not found");
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:device_statuses',
        ]);

        if ($validator->fails()) {
            return $this->respondWithError('Device status is already exists or is invalid');
        }
        try {
            $deviceStatus = new DeviceStatus();
            $deviceStatus->name = $request->name;
            $deviceStatus->added_by = auth()->user()->id;
            $deviceStatus->save();
            $deviceStatus->load('addedBy');
            return $this->respondWithSuccess('Device Status is successfully created', $deviceStatus);
        } catch (\Exception $e) {
            return $this->respondWithError('Something went wrong', $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        if($request->device_status_id){
            $deviceStatus = DeviceStatus::findOrFail($request->device_status_id);
        }else{
            return $this->respondWithError('Device status id is required');
        }
        if(!$deviceStatus){
            return $this->respondWithError('Device status is not found');
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:device_statuses,name,' . $request->device_status_id,
            ]);
        }
        if ($validator->fails()) {
            return $this->respondWithError('Device status name is required or already exists or invalid');
        }
        try {
            $deviceStatus->name = $request->name;
            $deviceStatus->added_by = auth()->user()->id;
            $deviceStatus->save();
            $deviceStatus->load('addedBy');
            return $this->respondWithSuccess('Device status is successfully updated', $deviceStatus);
        } catch (\Exception $e) {
            return $this->respondWithError('Something went wrong', $e->getMessage());
        }
    }

    public function delete($id){
        $deviceStatus = DeviceStatus::find($id);
        if(!$deviceStatus){
            return $this->respondWithError('Device status is not found');
        }else{
            try {
                $deviceStatus->delete();
                return $this->respondWithSuccess('Device status is successfully deleted');
            } catch (\Exception $e) {
                return $this->respondWithError('Something went wrong', $e->getMessage());
            }
        }
    }
}

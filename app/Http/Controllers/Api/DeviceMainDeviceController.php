<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceMainDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceMainDeviceController extends Controller
{
    public function fetchAll()
    {
        $mainDevices = DeviceMainDevice::select()->with('addedBy')->get();
        return $this->respondWithSuccess("Main Devices fetched successfully", $mainDevices);
    }
    public function fetch($id)
    {
        $mainDevice = DeviceMainDevice::select()->with('addedBy')->where('id', $id)->first();
        if($mainDevice){
            return $this->respondWithSuccess("Main Device fetched successfully", $mainDevice);
        }else{
            return $this->respondWithError("Main Device is not found");
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:device_main_devices',
        ]);

        if ($validator->fails()) {
            return $this->respondWithError('Main Device name is already exists or is invalid');
        }
        try {
            $mainDevice = new DeviceMainDevice();
            $mainDevice->name = $request->name;
            $mainDevice->added_by = auth()->user()->id;
            $mainDevice->save();
            $mainDevice->load('addedBy');
            return $this->respondWithSuccess('Main Device is successfully created', $mainDevice);
        } catch (\Exception $e) {
            return $this->respondWithError('Something went wrong', $e->getMessage());
        }
    }
    public function update(Request $request)
    {
        if($request->device_main_id){
            $mainDevice = DeviceMainDevice::findOrFail($request->device_main_id);
        }else{
            return $this->respondWithError('Main Device id is required');
        }
        if(!$mainDevice){
            return $this->respondWithError('Main Device is not found');
        }else{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:device_main_devices,name,' . $request->device_main_id,
            ]);
        }
        if ($validator->fails()) {
            return $this->respondWithError('Main Device name is required or already exists or invalid');
        }
        try {
            $mainDevice->name = $request->name;
            $mainDevice->added_by = auth()->user()->id;
            $mainDevice->save();
            $mainDevice->load('addedBy');
            return $this->respondWithSuccess('Main Device is successfully updated', $mainDevice);
        } catch (\Exception $e) {
            return $this->respondWithError('Something went wrong', $e->getMessage());
        }
    }

    public function delete($id){
        $mainDevice = DeviceMainDevice::find($id);
        if(!$mainDevice){
            return $this->respondWithError('Main Device is not found');
        }else{
            try {
                $mainDevice->delete();
                return $this->respondWithSuccess('Main Device is successfully deleted');
            } catch (\Exception $e) {
                return $this->respondWithError('Something went wrong', $e->getMessage());
            }
        }
    }
}

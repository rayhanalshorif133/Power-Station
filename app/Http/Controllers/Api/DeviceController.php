<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Validator;
use Exception;


class DeviceController extends Controller
{


    public function fetchDevice()
    {
        $devices = Device::select()->with('addedBy','deviceCategory','deviceArea','deviceSection','deviceMainDevice','deviceStatus')->get();
        foreach ($devices as $device) {
            $device->images  = json_decode($device->image);
            $device->status = $device->deviceStatus->name;
            unset($device['category_id']);
            unset($device['area_id']);
            unset($device['section_id']);
            unset($device['main_device_id']);
            unset($device['current_status_id']);
            unset($device['created_at']);
            unset($device['updated_at']);
            // unsetRelation('deviceStatus');
        }
        return $this->respondWithSuccess("Successfully fetched devices", $devices);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:devices,name',
            'category_id' => 'required|integer',
            'area_id' => 'required|integer',
            'section_id' => 'required|integer',
            'main_device_id' => 'required|integer',
            'status_id' => 'required|integer',
            'tag_no' => 'required|max:255|unique:devices,tag_no',
            'images' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->respondWithError('Device name is not unique or others credentials are invalid');
        }

        try {
            $device = new Device();
            $device->name = $request->name;
            $device->category_id = $request->category_id;
            $device->area_id = $request->area_id;
            $device->section_id = $request->section_id;
            $device->main_device_id = $request->main_device_id;
            $device->current_status_id = $request->status_id;
            $device->tag_no = $request->tag_no;
            $device->added_by = auth()->user()->id;

            if ($request->hasfile('images')) {
                $images = [];
                foreach ($request->file('images') as $image) {
                    $imageName = "device_image" . Date('d_m_y_h_m_s')  . $image->getClientOriginalName();
                    $image->storeAs('deviceImage/', $imageName, 'public');
                    $imageName = "storage" . "/" . "deviceImage" . "/" . $imageName;
                    $images[] =  $imageName;
                }
                $device->image = json_encode($images);
            }
            $device->description = $request->description;
            $device->save();
            $device->load('addedBy','deviceCategory', 'deviceArea', 'deviceSection', 'deviceMainDevice', 'deviceStatus');
            return $this->respondWithSuccess('Device created successfully', $device);
        } catch (Exception $e) {
            return $this->respondWithError("Error creating device", $e->getMessage());
        }
    }
}

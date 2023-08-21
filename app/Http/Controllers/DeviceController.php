<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceArea;
use App\Models\DeviceCategory;
use App\Models\DeviceMainDevice;
use App\Models\DeviceSection;
use App\Models\DeviceStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Exception;


class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::select()->with('deviceCategory', 'deviceArea', 'deviceSection', 'deviceMainDevice', 'deviceStatus')->get();
        foreach ($devices as $device) {
            $device->images  = json_decode($device->image);
        }
        $deviceStatuses = DeviceStatus::all();
        return view('device.index', compact('devices','deviceStatuses'));
    }

    public function fetchDeviceById($id)
    {
        $device = Device::where('id', $id)->with('deviceStatus')->first();
        return $this->respondWithSuccess('Successfully fetched device', $device);
    }

    public function create()
    {
        $deviceCategories = DeviceCategory::all();
        $areas = DeviceArea::all();
        $sections = DeviceSection::all();
        $mainDevices = DeviceMainDevice::all();
        $statuses = DeviceStatus::all();
        return view('device.create', compact('deviceCategories', 'areas', 'sections', 'mainDevices', 'statuses'));
    }

    public function store(Request $request)
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
            return $this->respondWithErrorWeb($validator->errors()->first());
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
            $device->createDeviceHistoryLog($device->id, 'Device created by');
            return $this->respondWithSuccessWeb("Device successfully created", redirect()->route('device.index'));
        } catch (Exception $e) {
            return $this->respondWithErrorWeb($e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:devices,name,' . $id,
            'category_id' => 'required|integer',
            'area_id' => 'required|integer',
            'section_id' => 'required|integer',
            'main_device_id' => 'required|integer',
            'status_id' => 'required|integer',
            'tag_no' => 'required|max:255|unique:devices,tag_no,' . $id,
        ]);
        if ($validator->fails()) {
            return $this->respondWithErrorWeb($validator->errors()->first());
        }

        try {
            $device = Device::find($id);
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
                $margeImage = json_decode($device->image);
                $margeImage = array_merge($margeImage, $images);
                $device->image = json_encode($margeImage);
            }
            $device->description = $request->description;
            $device->save();
            $device->createDeviceHistoryLog($device->id, 'Device updated by');
            return $this->respondWithSuccessWeb("Device successfully updated.", redirect()->route('device.index'));
        } catch (Exception $e) {
            return $this->respondWithErrorWeb($e->getMessage());
        }
    }
    public function updateStatus(Request $request){
        $devices = Device::whereIn('id', $request->ids)->get();
        foreach ($devices as $device) {
            $device->current_status_id = $request->status_id;
            $device->save();
            $device->createDeviceHistoryLog($device->id, 'Device status changed by');
        }
        return $this->respondWithSuccess("Device status successfully updated", $devices);
    }

    public function show($id){
        $device = Device::where('id', $id)->with('deviceCategory', 'deviceArea', 'deviceSection', 'deviceMainDevice', 'deviceStatus')->first();
        
        if($device){
            $device->images  = json_decode($device->image);
            return view('device.show', compact('device'));
        }else{
            return $this->respondWithErrorWeb("Device not found", redirect()->route('device.index'));
        }
    }
    public function edit($id){
        $device = Device::where('id', $id)->with('deviceCategory', 'deviceArea', 'deviceSection', 'deviceMainDevice', 'deviceStatus')->first();
        
        $deviceCategories = DeviceCategory::all();
        $areas = DeviceArea::all();
        $sections = DeviceSection::all();
        $mainDevices = DeviceMainDevice::all();
        $statuses = DeviceStatus::all();


        if($device){
            $device->images  = json_decode($device->image);
            return view('device.edit', compact('device', 'deviceCategories', 'areas', 'sections', 'mainDevices', 'statuses'));
        }else{
            return $this->respondWithErrorWeb("Device not found", redirect()->route('device.index'));
        }
    }

    public function deleteImageOneByOne(Request $request){
        $device = Device::find($request->id);
        $images = json_decode($device->image);
        $newImage = [];
        foreach ($images as $key => $image) {
            if($key == $request->imageKey){
                $image = str_replace("storage", "public", $image);
                Storage::delete($image);
            }else{
                $newImage[] = $image; 
            }
        }
        $device->image = json_encode($newImage);
        $device->save();
        $device->createDeviceHistoryLog($device->id, 'Device\'s image has been deleted by');
        return $this->respondWithSuccess("Image successfully deleted");
    }

    public function delete($id){
        $device = Device::find($id);
        $images = json_decode($device->image);
        foreach ($images as $key => $image) {
            $image = str_replace("storage", "public", $image);
            Storage::delete($image);
        }
        $device->delete();
        $device->createDeviceHistoryLog($device->id, 'Device deleted by');
        return $this->respondWithSuccess("Device successfully deleted");
    }
    public function multiDeviceDelete(Request $request){
        $devices = Device::whereIn('id', $request->ids)->get();
        foreach ($devices as $device){
            $images = json_decode($device->image);
            foreach ($images as $key => $image) {
                $image = str_replace("storage", "public", $image);
                Storage::delete($image);
            }
            $device->createDeviceHistoryLog($device->id, 'Device deleted by');
            $device->delete();
        }
        return $this->respondWithSuccess("Device successfully deleted", $devices);
    }


    // Footer Fetch Devices
    public function fetchFooterDevice(){
        $devices = Device::select('id', 'name')
                            ->take(5)
                            ->get();
        return $this->respondWithSuccess("Devices successfully fetched", $devices);
    }
}

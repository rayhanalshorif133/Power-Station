<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\DeviceStatus;


class LearningController extends Controller
{
    public function publicDashboard()
    {
        return view('public.learning.dashboard');
    }
    public function publicIndex()
    {
        $devices = Device::select()->with('deviceCategory', 'deviceArea', 'deviceSection', 'deviceMainDevice', 'deviceStatus')->get();
        foreach ($devices as $device) {
            $device->images  = json_decode($device->image);
        }
        $deviceStatuses = DeviceStatus::all();
        return view('public.learning.index', compact('devices','deviceStatuses'));
    }
    public function publicDeviceStatusList()
    {
        $devices = Device::select()->with('deviceCategory', 'deviceArea', 'deviceSection', 'deviceMainDevice', 'deviceStatus')->get();
        foreach ($devices as $device) {
            $device->images  = json_decode($device->image);
        }
        $deviceStatuses = DeviceStatus::all();
        return view('public.learning.device-status-list', compact('devices','deviceStatuses'));
    }
    public function publicDeviceDetails($id)
    {

        $device = Device::select()
        ->where('id', $id)
        ->with('deviceCategory', 'deviceArea', 'deviceSection', 'deviceMainDevice', 'deviceStatus')
        ->first();
        $device->images  = json_decode($device->image);
        $deviceStatuses = DeviceStatus::all();
        
        return view('public.learning.device-details', compact('device','deviceStatuses'));
    }
}

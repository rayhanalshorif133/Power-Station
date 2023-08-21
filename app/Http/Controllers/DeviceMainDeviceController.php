<?php

namespace App\Http\Controllers;

use App\Models\DeviceMainDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;

class DeviceMainDeviceController extends Controller
{
    public function index()
    {
        $deviceMainDevices = DeviceMainDevice::select()->with('addedBy')->get();
        return view('device.main-device.index', compact('deviceMainDevices'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:device_main_devices',
        ]);


        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }

        try {
            $mainDevice = new DeviceMainDevice();
            $mainDevice->name = $request->name;
            $mainDevice->added_by = auth()->user()->id;
            $mainDevice->save();
            Session::flash('message', 'Main device successfully created');
            Session::flash('class', 'success');
            return redirect()->back();
        } catch (Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:device_main_devices,name,' . $request->id,
        ]);

        if ($validator->fails()) {
            return $this->respondWithError($validator->errors()->first());
        }
        try {
            $mainDevice = DeviceMainDevice::find($request->id);
            $mainDevice->name = $request->name;
            $mainDevice->added_by = auth()->user()->id;
            $mainDevice->save();
            $mainDevice->load('addedBy');
            return $this->respondWithSuccess('Main device successfully updated', $mainDevice);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $mainDevice = DeviceMainDevice::find($id);
            $mainDevice->delete();
            return $this->respondWithSuccess('Main device successfully deleted');
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function destroySelected(Request $request)
    {
        try {
            $mainDevices = DeviceMainDevice::whereIn('id', $request->ids)->get();
            foreach ($mainDevices as $mainDevice) {
                $mainDevice->delete();
            }
            return $this->respondWithSuccess('Main devices successfully deleted', $mainDevices);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}

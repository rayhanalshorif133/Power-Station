<?php

namespace App\Http\Controllers;

use App\Models\DeviceStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DeviceStatusController extends Controller
{
    public function index()
    {
        $deviceStatuses = DeviceStatus::select()->with('addedBy')->get();
        return view('device.status.index', compact('deviceStatuses'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:device_statuses',
        ]);


        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }

        try {
            $status = new DeviceStatus();
            $status->name = $request->name;
            $status->added_by = auth()->user()->id;
            $status->save();
            Session::flash('message', 'Status successfully created');
            Session::flash('class', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            Session::flash('message', $e->getMessage());
            Session::flash('class', 'danger');
            return redirect()->back();
        }
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:device_statuses,name,' . $request->id,
        ]);
        
        if ($validator->fails()) {
            return $this->respondWithError("Name field is required or already exists");
        }
        
        try {
            $status = DeviceStatus::find($request->id);
            $status->name = $request->name;
            $status->added_by = auth()->user()->id;
            $status->save();
            $status->load('addedBy');
            return $this->respondWithSuccess('Status successfully updated', $status);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $status = DeviceStatus::find($id);

        if(!$status){
            return $this->respondWithError('Status is not found');
        }
        try {
            $status->delete();
            return $this->respondWithSuccess('Status successfully deleted');
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function destroySelected(Request $request)
    {
        try {
            $deviceStatuses = DeviceStatus::whereIn('id', $request->ids)->get();
            foreach ($deviceStatuses as $deviceStatus) {
                $deviceStatus->delete();
            }
            return $this->respondWithSuccess('Device Status successfully deleted', $deviceStatuses);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}

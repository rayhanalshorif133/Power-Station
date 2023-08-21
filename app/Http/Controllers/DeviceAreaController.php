<?php

namespace App\Http\Controllers;

use App\Models\DeviceArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;



class DeviceAreaController extends Controller
{
    public function index()
    {
        $deviceAreas = DeviceArea::select()->with('addedBy')->get();
        return view('device.area.index', compact('deviceAreas'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:device_areas',
        ]);


        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }

        try {
            $area = new DeviceArea();
            $area->name = $request->name;
            $area->added_by = auth()->user()->id;
            $area->save();
            Session::flash('message', 'Area successfully created');
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
            'name' => 'required|string|max:255|unique:device_areas,name,' . $request->id,
        ]);

        if ($validator->fails()) {
            return $this->respondWithError($validator->errors()->first());
        }
        try {
            $deviceArea = DeviceArea::find($request->id);
            $deviceArea->name = $request->name;
            $deviceArea->added_by = auth()->user()->id;
            $deviceArea->save();
            $deviceArea->load('addedBy');
            return $this->respondWithSuccess('Device area successfully updated', $deviceArea);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

    }

    public function destroy($id){
        try {
            $deviceArea = DeviceArea::find($id);
            if($deviceArea){
                $deviceArea->delete();
                return $this->respondWithSuccess('Device area successfully deleted');
            }else{
                return $this->respondWithError('Device area not found');
            }
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function destroySelected(Request $request){
        try {
            $deviceAreas = DeviceArea::whereIn('id', $request->ids)->get();
            if($deviceAreas){
                foreach ($deviceAreas as $deviceArea){
                    $deviceArea->delete();
                }
                return $this->respondWithSuccess('Device areas successfully deleted');
            }else{
                return $this->respondWithError('Device areas not found');
            }
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }




}

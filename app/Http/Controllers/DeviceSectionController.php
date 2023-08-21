<?php

namespace App\Http\Controllers;

use App\Models\DeviceSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DeviceSectionController extends Controller
{
    public function index()
    {
        $deviceSections = DeviceSection::select()->with('addedBy')->get();
        return view('device.section.index', compact('deviceSections'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:device_sections',
        ]);


        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }
        try {
            $section = new DeviceSection();
            $section->name = $request->name;
            $section->added_by = auth()->user()->id;
            $section->save();
            Session::flash('message', 'Section successfully created');
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
            'name' => 'required|string|max:255|unique:device_sections,name,' . $request->id,
        ]);
        if ($validator->fails()) {
            return $this->respondWithError("Name field is required or already exists");
        }
        
        try {
            $section = DeviceSection::find($request->id);
            $section->name = $request->name;
            $section->added_by = auth()->user()->id;
            $section->save();
            $section->load('addedBy');
            return $this->respondWithSuccess('section successfully updated', $section);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function destroy($id){
        try {
            $section = DeviceSection::find($id);
            if($section){
                $section->delete();
                return $this->respondWithSuccess('section successfully deleted');
            }else{
                return $this->respondWithError('section not found');
            }
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    public function destroySelected(Request $request){
        try {
            $sections = DeviceSection::whereIn('id', $request->ids)->get();
            if($sections){
                foreach ($sections as $section) {
                    $section->delete();
                }
                return $this->respondWithSuccess('section successfully deleted',[]);
            }else{
                return $this->respondWithError('section not found');
            }
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

}

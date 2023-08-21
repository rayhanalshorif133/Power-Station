<?php

namespace App\Http\Controllers;

use App\Models\DeviceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DeviceCategoryController extends Controller
{
    public function index()
    {
        $deviceCategories = DeviceCategory::select()->with('addedBy')->get();
        return view('device.category.index', compact('deviceCategories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:device_categories',
        ]);


        if ($validator->fails()) {
            Session::flash('message', $validator->errors()->first());
            Session::flash('class', 'danger');
            return redirect()->back()->withInput();
        }

        try {
            $category = new DeviceCategory();
            $category->name = $request->name;
            $category->added_by = auth()->user()->id;
            $category->save();
            Session::flash('message', 'Category successfully created');
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

        $deviceCategory = DeviceCategory::find($request->id);


        if(!$deviceCategory){
           return $this->respondWithError('Category not found');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:device_categories,name,' . $request->id,
        ]);
        
        if ($validator->fails()) {
            return $this->respondWithError($validator->errors()->first());
        }
        
        try {
            $deviceCategory->name = $request->name;
            $deviceCategory->added_by = auth()->user()->id;
            $deviceCategory->save();
            $deviceCategory->load('addedBy');
            return $this->respondWithSuccess('Category successfully updated', $deviceCategory);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

    }

    public function destroy($id){
        $deviceCategory = DeviceCategory::find($id);
        if(!$deviceCategory){
            return $this->respondWithError('Category not found');
        }
        try {
            $deviceCategory->delete();
            return $this->respondWithSuccess('Category successfully deleted');
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function destroySelected(Request $request){
        $ids = $request->ids;
        try {
            DeviceCategory::whereIn('id', $ids)->delete();
            return $this->respondWithSuccess('Categories successfully deleted');
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}

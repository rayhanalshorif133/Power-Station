<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceCategoryController extends Controller
{
    public function fetchCategory($id = null)
    {
        if($id){
            $deviceCategories = DeviceCategory::select()->where('id', $id)->with('addedBy')->get();
        }else{
            $deviceCategories = DeviceCategory::select()->with('addedBy')->get();
        }

        foreach($deviceCategories as $deviceCategory){
            $deviceCategory->added_by = [
                'id' => $deviceCategory->addedBy->id,
                'name' => $deviceCategory->addedBy->name,
            ];
            unset($deviceCategory->addedBy);
        }
        return $this->respondWithSuccess('Successfully Device Categories are Fetched', $deviceCategories);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:device_categories',
        ]);
        
        
        if ($validator->fails()) {
            return $this->respondWithError("Category name is not valid or not unique", [], 203);
        }
        try {
            $category = new DeviceCategory();
            $category->name = $request->name;
            $category->added_by = auth()->user()->id;
            $category->save();
            return $this->respondWithSuccess('Device Category Created', $category);
        } catch (\Exception $e) {
            return $this->respondWithError("Error", $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {

        $deviceCategory = DeviceCategory::find($request->id);
        if(!$deviceCategory){
           return $this->respondWithError('Category is not found');
        }

         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:device_categories,name,' . $id,
        ]);
        
        
        if ($validator->fails()) {
            return $this->respondWithError("Category name is not valid or not unique", [], 203);
        }
        try {
            $category = DeviceCategory::find($id);
            $category->name = $request->name;
            $category->added_by = auth()->user()->id;
            $category->save();
            return $this->respondWithSuccess('Device Category Created', $category);
        } catch (\Exception $e) {
            return $this->respondWithError("Error", $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $category = DeviceCategory::find($id);
            if($category){
                $category->delete();
                return $this->respondWithSuccess('Device Category has been deleted');
            }else{
                return $this->respondWithError("Category is not found", [], 203);
            }
        } catch (\Exception $e) {
            return $this->respondWithError("Error", $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\DeviceCategory;
use App\Models\GoodsTools;
use App\Models\Room;
use App\Models\RoomDetails;
use App\Models\DeviceStock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class GoodsToolsController extends Controller
{
    public function index()
    {
        $devices = Device::select()->take(1)->get();
        $deviceCategories = DeviceCategory::all();
        $rooms = Room::all();
        $goodsTools = GoodsTools::select()->with('addedBy','device','stock')->get();
        return view('goods-tools.index', compact('devices', 'deviceCategories', 'goodsTools','rooms'));
    }
    public function fetch($id)
    {
        $goodsTools = GoodsTools::select()->with('addedBy','device','deviceCategory')->where('id', $id)->first();
        return $this->respondWithSuccess("Successfully fetch goods tools data",$goodsTools);
    }
    public function show($id)
    {
        $goodsTool = GoodsTools::select()->where("id",$id)->with('addedBy','device','roomDetails','roomDetails.room')->first();
        $getDeviceStock = DeviceStock::where('device_id', $goodsTool->device_id)->first();
        if($getDeviceStock) {
            $goodsTool->stock_quantity = $getDeviceStock->quantity;
        } else {
            $goodsTool->stock_quantity = 0;
        }
        $goodsTool->total_quantity = $goodsTool->stock_quantity;
        return view('goods-tools.show', compact('goodsTool'));
    }
    public function fetchDeviceByCategoryId($id)
    {
        $devices = Device::select('id','name')->where('category_id', $id)->get();
        return $this->respondWithSuccess("Successfully fetch device list data",$devices);
    }
    public function fetchRackByRoomId($id)
    {
        $room = Room::select('id','name')->where('id',$id)->first();
        $roomDetails = RoomDetails::select('id','rack','shelf','room_id')->where('room_id',$id)->get();
        $room->rack = $room->countOfRacks($room->id);
        $room->shelf = $room->countOfShelfs($room->id);
        $room->roomDetails = $roomDetails;
        return $this->respondWithSuccess("Successfully fetch room data",$room);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'device_id' => 'required',
            'image' => 'required',
        ]);
        
        if ($validator->fails()) {
            return $this->respondWithErrorWeb($validator->errors()->first());
        }

        
        try {
            
            $findGoodsTools = GoodsTools::where('device_id', $request->device_id)->first();
            if($findGoodsTools){
                return $this->respondWithErrorWeb("Goods Tools already exist");
            }
            $goodsTool = new GoodsTools();
            $goodsTool->device_id = $request->device_id;
            $goodsTool->added_by = auth()->user()->id;
            $goodsTool->description = $request->description;


            $roomDetails = RoomDetails::select()
                ->where('room_id', $request->room_id)
                ->where('rack', $request->rack_id)
                ->where('shelf', $request->shelf_id)
                ->first();
            $goodsTool->room_details_id = $roomDetails->id;
            
             if ($request->hasfile('image')) {
                $imageName = "goods_tools_image" . Date('d_m_y_h_m_s')  . $request->image->getClientOriginalName();
                $request->image->storeAs('goodsTools/', $imageName, 'public');
                $imageName = "storage" . "/" . "goodsTools" . "/" . $imageName;
                $goodsTool->image = $imageName;
            }
            $goodsTool->save();
            $goodsTool->createGoodsToolsHistoryLog($goodsTool->id,"Goodstools created by");
            return $this->respondWithSuccessWeb('Goods Tool Added Successfully');
        } catch (\Exception $e) {
            return $this->respondWithErrorWeb($e->getMessage());
        }
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return $this->respondWithErrorWeb($validator->errors()->first());
        }
        
        try {
            $findGoodsTools = GoodsTools::where('id', '!=', $request->goodsToolsID)
                    ->where('device_id', $request->device_id)
                    ->first();
            if($findGoodsTools){
                return $this->respondWithErrorWeb("Goods Tools already exist");
            }

            $goodsTool = GoodsTools::find($request->goodsToolsID);
            $goodsTool->device_id = $request->device_id;
            $goodsTool->added_by = auth()->user()->id;
            $goodsTool->device_category_id = $request->category_id;
            $goodsTool->description = $request->description;
            
            if ($request->hasfile('image')) {
                $image = str_replace("storage", "public", $goodsTool->image);
                Storage::delete($image);
                $imageName = "goods_tools_image" . Date('d_m_y_h_m_s')  . $request->image->getClientOriginalName();
                $request->image->storeAs('goodsTools/', $imageName, 'public');
                $imageName = "storage" . "/" . "goodsTools" . "/" . $imageName;
                $goodsTool->image = $imageName;
            }
            $goodsTool->save();
            return $this->respondWithSuccessWeb('Goods Tool Updated Successfully');
        } catch (\Exception $e) {
            return $this->respondWithErrorWeb($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $goodsTool = GoodsTools::find($id);
            if($goodsTool){
                $image = str_replace("storage", "public", $goodsTool->image);
                Storage::delete($image);
                $goodsTool->delete();
                return $this->respondWithSuccess('Goods Tool Deleted Successfully');
            }else{
                return $this->respondWithError('Goods Tool Not Found');
            }
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}

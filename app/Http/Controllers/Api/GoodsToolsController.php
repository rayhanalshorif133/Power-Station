<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoodsTools;
use App\Models\DeviceStock;
use App\Models\RoomDetails;
use App\Models\Room;
use App\Models\Device;
use App\Models\GoodsToolsLog;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;



class GoodsToolsController extends Controller
{
    public function fetch($id = null) {
        if($id) {
            $goodsTools = GoodsTools::select()->where('id',$id)->with('addedBy','device','roomDetails','roomDetails.room')->get();
        } else {
            $goodsTools = GoodsTools::select()->with('addedBy','device','roomDetails','roomDetails.room')->get();
        }
        foreach($goodsTools as $goodsTool) {
            $goodsTool->added_by = $goodsTool->addedBy->name;
            $goodsTool->device_info = [
                'device_id' => $goodsTool->device->id,
                'device_name' => $goodsTool->device->name,
                'category_name' => $goodsTool->device->deviceCategory->name
            ];
            $getDeviceStock = DeviceStock::where('device_id', $goodsTool->device_id)->first();
            if($getDeviceStock) {
                $goodsTool->stock_quantity = $getDeviceStock->quantity;
            } else {
                $goodsTool->stock_quantity = 0;
            }
            $goodsTool->total_quantity = $goodsTool->stock_quantity;
            unset($goodsTool->device);
            unset($goodsTool->deviceCategory);
            unset($goodsTool->device_id);
            unset($goodsTool->device_category_id);
            unset($goodsTool->addedBy);
            unset($goodsTool->created_at);
            unset($goodsTool->updated_at);
            // Room Details customizations
            unset($goodsTool->room_details_id);
            $goodsTool->room_details = [
                'room_id' => $goodsTool->roomDetails->room->id,
                'room_name' => $goodsTool->roomDetails->room->name,
                'rack_number' => $goodsTool->roomDetails->rack,
                'shelf_number' => $goodsTool->roomDetails->shelf,
            ];
            unset($goodsTool->roomDetails);
        }

        if(count($goodsTools) > 0){
            return $this->respondWithSuccess("Successfully fetch goodsTools data", $goodsTools);
        }else{
            return $this->respondWithError("No goodsTools data found");
        }

    }
    public function fetchWithFilter($filter = null) {
        

        if($filter){
            $device_ids = Device::select('id')->where('name', 'like', '%'.$filter.'%')->get();        
            $goodsTools = GoodsTools::select()
            ->with('addedBy','device','roomDetails','roomDetails.room')
            ->whereIn('device_id', $device_ids)
            ->get();
        }else{
            $goodsTools = GoodsTools::select()->with('addedBy','device','roomDetails','roomDetails.room')->get();
        }


        foreach($goodsTools as $goodsTool) {
            $goodsTool->added_by = $goodsTool->addedBy->name;
            $goodsTool->device_info = [
                'device_id' => $goodsTool->device->id,
                'device_name' => $goodsTool->device->name,
                'category_name' => $goodsTool->device->deviceCategory->name
            ];
            $getDeviceStock = DeviceStock::where('device_id', $goodsTool->device_id)->first();
            if($getDeviceStock) {
                $goodsTool->stock_quantity = $getDeviceStock->quantity;
            } else {
                $goodsTool->stock_quantity = 0;
            }
            $goodsTool->total_quantity = $goodsTool->stock_quantity;
            unset($goodsTool->device);
            unset($goodsTool->deviceCategory);
            unset($goodsTool->device_id);
            unset($goodsTool->device_category_id);
            unset($goodsTool->addedBy);
            unset($goodsTool->created_at);
            unset($goodsTool->updated_at);
            // Room Details customizations
            unset($goodsTool->room_details_id);
            $goodsTool->room_details = [
                'room_id' => $goodsTool->roomDetails->room->id,
                'room_name' => $goodsTool->roomDetails->room->name,
                'rack_number' => $goodsTool->roomDetails->rack,
                'shelf_number' => $goodsTool->roomDetails->shelf,
            ];
            unset($goodsTool->roomDetails);
        }

        if(count($goodsTools) > 0){
            return $this->respondWithSuccess("Successfully fetch goodsTools data", $goodsTools);
        }else{
            return $this->respondWithError("No goodsTools data found");
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'device_id' => 'required',
            'image' => 'required',
            'room_id' => 'required',
            'rack_number' => 'required',
            'shelf_number' => 'required',
        ]);
        
        if ($validator->fails()) {
            return $this->respondWithError("Device id and image is required");
        }
        
        try {

            $findGoodsTools = GoodsTools::where('device_id', $request->device_id)->first();
            if($findGoodsTools){
                return $this->respondWithError("Goods Tools already exist");
            }
            $goodsTool = new GoodsTools();
            $goodsTool->device_id = $request->device_id;
            $goodsTool->added_by = auth()->user()->id;
            $goodsTool->description = $request->description;

             $roomDetails = RoomDetails::select()
                ->where('room_id', $request->room_id)
                ->where('rack', $request->rack_number)
                ->where('shelf', $request->shelf_number)
                ->first();
            $findGoodsTools = GoodsTools::where('room_details_id', $roomDetails->id)->first();
            if($findGoodsTools){
                return $this->respondWithError("Room, Rack or Shelf is already booked");
            }
            $goodsTool->room_details_id = $roomDetails->id;

             if ($request->hasfile('image')) {
                $imageName = "goods_tools_image" . Date('d_m_y_h_m_s')  . $request->image->getClientOriginalName();
                $request->image->storeAs('goodsTools/', $imageName, 'public');
                $imageName = "storage" . "/" . "goodsTools" . "/" . $imageName;
                $goodsTool->image = $imageName;
            }
            $goodsTool->save();
            $goodsTool->load('addedBy','device','roomDetails','roomDetails.room');
            $goodsTool->added_by = $goodsTool->addedBy->name;
            unset($goodsTool->addedBy);
            unset($goodsTool->created_at);
            unset($goodsTool->updated_at);
            $goodsTool->device_info = [
                'device_id' => $goodsTool->device->id,
                'device_name' => $goodsTool->device->name,
                'category_id' => $goodsTool->device->deviceCategory->id,
                'category_name' => $goodsTool->device->deviceCategory->name
            ];
            unset($goodsTool->device);
            unset($goodsTool->device_id);

            // Room Details customizations
            unset($goodsTool->room_details_id);
            $goodsTool->room_details = [
                'room_id' => $goodsTool->roomDetails->room->id,
                'room_name' => $goodsTool->roomDetails->room->name,
                'rack_number' => $goodsTool->roomDetails->rack,
                'shelf_number' => $goodsTool->roomDetails->shelf,
            ];
            unset($goodsTool->roomDetails);
            $goodsTool->createGoodsToolsHistoryLog($goodsTool->id,"Goodstools created by");
            return $this->respondWithSuccess('Goods Tool Added Successfully',$goodsTool);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
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
    public function fetchShelfByRoomAndRackId($roomId, $rackNumber)
    {
        $roomDetails = RoomDetails::select()
                ->where('room_id', $roomId)
                ->where('rack', $rackNumber)
                ->get();
        return $this->respondWithSuccess("Successfully fetch room data",$roomDetails);
    }

    public function fetchGoodsToolsLogs($id = null)
    {
        if($id != null) {
            $goodsToolsLogs = GoodsToolsLog::where('goods_tools_id', $id)->with('goodsTools')->get();
        }else{
            $goodsToolsLogs = GoodsToolsLog::select()->with('goodsTools')->get();
        }

        foreach($goodsToolsLogs as $goodsToolsLog) {
            $goodsToolsLog->goods_tools = [
                'id' => $goodsToolsLog->goodsTools->id,
                'device_id' => $goodsToolsLog->goodsTools->device_id,
                'device_name' => $goodsToolsLog->goodsTools->device->name,
                'category_id' => $goodsToolsLog->goodsTools->device->deviceCategory->id,
                'category_name' => $goodsToolsLog->goodsTools->device->deviceCategory->name,
                'room_id' => $goodsToolsLog->goodsTools->roomDetails->room->id,
                'room_name' => $goodsToolsLog->goodsTools->roomDetails->room->name,
                'rack_number' => $goodsToolsLog->goodsTools->roomDetails->rack,
                'shelf_number' => $goodsToolsLog->goodsTools->roomDetails->shelf,
            ];
            unset($goodsToolsLog->goodsTools);
            unset($goodsToolsLog->goods_tools_id);
        }

        if(count($goodsToolsLogs) > 0){
            return $this->respondWithSuccess('Successfully fetch Goods Tools logs', $goodsToolsLogs);
        }else{
            return $this->respondWithError('No Goods Tools logs found');
        }
    }


    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'goods_tools_id' => 'required',
            'device_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return $this->respondWithError($validator->errors()->first());
        }
        
        try {
            $findGoodsTools = GoodsTools::where('id', '!=', $request->goods_tools_id)
                    ->where('device_id', $request->device_id)
                    ->first();
            if($findGoodsTools){
                return $this->respondWithError("Goods Tools already exist");
            }

            $goodsTool = GoodsTools::find($request->goods_tools_id);
            $goodsTool->device_id = $request->device_id;
            $goodsTool->added_by = auth()->user()->id;
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
            $goodsTool->added_by = $goodsTool->addedBy->name;
            unset($goodsTool->addedBy);
            unset($goodsTool->created_at);
            unset($goodsTool->updated_at);
            $goodsTool->device_info = [
                'device_id' => $goodsTool->device->id,
                'device_name' => $goodsTool->device->name,
                'category_id' => $goodsTool->device->deviceCategory->id,
                'category_name' => $goodsTool->device->deviceCategory->name
            ];
            unset($goodsTool->device);
            unset($goodsTool->device_id);
            $goodsTool->stock = "Stock and room working on";
            return $this->respondWithSuccess('Goods Tool Updated Successfully',$goodsTool);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
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

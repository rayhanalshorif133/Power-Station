<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceStock;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;

class DeviceStockController extends Controller
{
    public function fetch($id = null)
    {
        if ($id) {
            $deviceStocks = DeviceStock::select('id','device_id','user_id','quantity')
                                        ->where('id', $id)
                                        ->with('device','user')
                                        ->first();
            $deviceStocks->device_info = [
                'id' => $deviceStocks->device->id,
                'name' => $deviceStocks->device->name,
            ];
            $deviceStocks->user_info = [
                'id' => $deviceStocks->user->id,
                'name' => $deviceStocks->user->name,
            ];
            unset($deviceStocks->device);
            unset($deviceStocks->user);
            unset($deviceStocks->device_id);
            unset($deviceStocks->user_id);
        } else {
            $deviceStocks = DeviceStock::select('id','device_id','user_id','quantity')
                                        ->with('device','user')
                                        ->get();
            foreach ($deviceStocks as $deviceStock) {
                $deviceStock->device_info = [
                    'id' => $deviceStock->device->id,
                    'name' => $deviceStock->device->name,
                ];
                $deviceStock->user_info = [
                    'id' => $deviceStock->user->id,
                    'name' => $deviceStock->user->name,
                ];
                unset($deviceStock->device);
                unset($deviceStock->user);
                unset($deviceStock->device_id);
                unset($deviceStock->user_id);
            }
        }
        return $this->respondWithSuccess("Successfully fetch device stock data",$deviceStocks);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required|integer|unique:device_stocks,device_id',
            'user_id' => 'required',
            'quantity' => 'required',
        ]);
         if ($validator->fails()) {
            if($validator->errors()->first() === "The device id has already been taken."){
                return $this->respondWithError("The device has already been taken.");
            }else{
                return $this->respondWithError($validator->errors()->first());
            }
        }
        try{
            $newDeviceStock = new DeviceStock();
            $newDeviceStock->device_id = $request->device_id;
            $newDeviceStock->user_id = $request->user_id;
            $newDeviceStock->quantity = $request->quantity;
            $newDeviceStock->save();
            $newDeviceStock->load('device','user');
            $newDeviceStock->device_info = [
                'id' => $newDeviceStock->device->id,
                'name' => $newDeviceStock->device->name,
            ];
            $newDeviceStock->user_info = [
                'id' => $newDeviceStock->user->id,
                'name' => $newDeviceStock->user->name,
            ];
            unset($newDeviceStock->device);
            unset($newDeviceStock->user);
            unset($newDeviceStock->device_id);
            unset($newDeviceStock->user_id);
            unset($newDeviceStock->created_at);
            unset($newDeviceStock->updated_at);
            return $this->respondWithSuccess("Device Stock Updated Successfully",$newDeviceStock);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

     public function update(Request $request) {
         $validator = Validator::make($request->all(), [
            'stock_id' => 'required|integer',
            'device_id' => 'required|integer',
            'user_id' => 'required',
            'quantity' => 'required',
        ]);
         if ($validator->fails()) {
            return $this->respondWithError($validator->errors()->first());
        }
        try{
            $deviceStock = DeviceStock::find($request->stock_id);
            if(!$deviceStock) {
                return $this->respondWithError("Device Stock is not found");
            }
            $getCountDevices = DeviceStock::select()
                    ->where('id', '!=', $request->stock_id)
                    ->where('device_id', $request->device_id)
                    ->count();
            if($getCountDevices > 0) {
                return $this->respondWithError("The device has already been taken.");
            }else{
                $deviceStock->device_id = $request->device_id;
                $deviceStock->user_id = $request->user_id;
                $deviceStock->quantity = $request->quantity;
                $deviceStock->save();
                $deviceStock->load('device','user');
                $deviceStock->device_info = [
                'id' => $deviceStock->device->id,
                'name' => $deviceStock->device->name,
                ];
                $deviceStock->user_info = [
                    'id' => $deviceStock->user->id,
                    'name' => $deviceStock->user->name,
                ];
                unset($deviceStock->device);
                unset($deviceStock->user);
                unset($deviceStock->device_id);
                unset($deviceStock->user_id);
                unset($deviceStock->created_at);
                unset($deviceStock->updated_at);
                return $this->respondWithSuccess("Device Stock Updated Successfully",$deviceStock);
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

     public function delete($id) {
        try{
            $deviceStock = DeviceStock::find($id);
            if($deviceStock){
                $deviceStock->delete();
                return $this->respondWithSuccess("Device Stock Deleted Successfully");
            }else{
                return $this->respondWithError("Device Stock Not Found");
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}

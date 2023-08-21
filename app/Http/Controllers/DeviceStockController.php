<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\User;
use App\Models\DeviceStock;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;


class DeviceStockController extends Controller
{
    public function index()
    {
        $devices = Device::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();
        $deviceStocks = DeviceStock::with('device', 'user')
            ->orderBy('id', 'desc')
            ->get();
        return view('device-stock.index', compact('devices', 'users', 'deviceStocks'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_id' => 'required|integer|unique:device_stocks,device_id',
            'user_id' => 'required',
            'stockQuantity' => 'required',
        ]);
         if ($validator->fails()) {
            if($validator->errors()->first() === "The device id has already been taken."){
                return $this->respondWithErrorWeb("The device has already been taken.");
            }else{
                return $this->respondWithErrorWeb($validator->errors()->first());
            }
        }
        try{
            $newDeviceStock = new DeviceStock();
            $newDeviceStock->device_id = $request->device_id;
            $newDeviceStock->user_id = $request->user_id;
            $newDeviceStock->quantity = $request->stockQuantity;
            $newDeviceStock->save();
            return $this->respondWithSuccessWeb("Device Stock Updated Successfully");
        } catch (Exception $e) {
            return $this->respondWithErrorWeb($e->getMessage());
        }
    }

    public function update(Request $request) {
         $validator = Validator::make($request->all(), [
            'device_id' => 'required|integer',
            'user_id' => 'required',
            'stockQuantity' => 'required',
        ]);
         if ($validator->fails()) {
            return $this->respondWithErrorWeb($validator->errors()->first());
        }
        try{
            $deviceStock = DeviceStock::find($request->stock_id);
            $getCountDevices = DeviceStock::select()
                    ->where('id', '!=', $request->stock_id)
                    ->where('device_id', $request->device_id)
                    ->count();
            if($getCountDevices > 0) {
                return $this->respondWithErrorWeb("The device has already been taken.");
            }else{
                $deviceStock->device_id = $request->device_id;
                $deviceStock->user_id = $request->user_id;
                $deviceStock->quantity = $request->stockQuantity;
                $deviceStock->save();
                return $this->respondWithSuccessWeb("Device Stock Updated Successfully");
            }
        } catch (Exception $e) {
            return $this->respondWithErrorWeb($e->getMessage());
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

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomDetails;
use Illuminate\Support\Facades\Validator;
use Exception;


class RoomController extends Controller
{

    public function fetch($id = null){
        if($id){
            $rooms = Room::select()->where('id', $id)->with('addedBy')->get();
        }else{
            $rooms = Room::select()->with('addedBy')->get();
        }
        foreach ($rooms as $room) {
            $room->added_by = [
                'id' => $room->addedBy->id,
                'name' => $room->addedBy->name,
            ];
            $room->rack = $room->countOfRacks($room->id);
            $room->shelf = $room->countOfShelfs($room->id);
            unset($room->addedBy);
            unset($room->created_at);
            unset($room->updated_at);
        }
        return $this->respondWithSuccess("Successfully fetch room data",$rooms);
    }
    public function filterByRoomName($name = null){
        if($name){
            $rooms = Room::select()->where('name', 'LIKE', '%'.$name.'%')->with('addedBy')->get();
        }else{
            $rooms = Room::select()->with('addedBy')->get();
        }
        foreach ($rooms as $room) {
            $room->added_by = [
                'id' => $room->addedBy->id,
                'name' => $room->addedBy->name,
            ];
            $room->rack = $room->countOfRacks($room->id);
            $room->shelf = $room->countOfShelfs($room->id);
            unset($room->addedBy);
            unset($room->created_at);
            unset($room->updated_at);
        }
        if(count($rooms) > 0){
            return $this->respondWithSuccess("Successfully fetch room data",$rooms);
        }else{
            return $this->respondWithError("Room not found");
        }
    }


      public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:rooms',
        ]);
        
        if ($validator->fails()) {
            return $this->respondWithError($validator->errors()->first());
        }
        try{
            $room = new Room();
            $room->name = $request->name;
            $room->added_by = auth()->user()->id;
            $room->description = $request->description;
            $room->save();
            foreach ($request->rack_details as $key => $rackDetail) {
            for ($ndex=0; $ndex < $rackDetail['shelf']; $ndex++) { 
             RoomDetails::create(
                    [
                        'room_id' => $room->id,
                        'rack' => $rackDetail['rack'],
                        'shelf' => $ndex+1,
                    ]);
            }
        }
        $room->load('addedBy');
        $room->added_by = [
            'id' => $room->addedBy->id,
            'name' => $room->addedBy->name,
        ];
        $room->rack = (int)$room->countOfRacks($room->id);
        $room->shelf = $room->countOfShelfs($room->id);
        unset($room->addedBy);
        unset($room->created_at);
        unset($room->updated_at);
        return $this->respondWithSuccess('Room created successfully',$room);
        }catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        $roomDetails = RoomDetails::where('room_id',$id)->get();
        if($roomDetails){
            foreach ($roomDetails as $roomDetail) {
                $roomDetail->delete();
            }
            if($room){
                $room->delete();
                return $this->respondWithSuccess('Room deleted successfully');
            }else{
                return $this->respondWithError('Room not found');
            }
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomDetails;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Exception;



class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::select()->with('addedBy')->get();
        foreach ($rooms as $room) {
            $room->rack = $room->countOfRacks($room->id);
            $room->shelf = $room->countOfShelfs($room->id);
        }
        return view('room.index', compact('rooms'));
    }
    public function create()
    {
        return view('room.create');
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
        return $this->respondWithSuccess('Room created successfully');
        }catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function delete($id)
    {
        try{
            $room = Room::find($id);
            if($room){
                $room->delete();
                return $this->respondWithSuccess('Room is deleted successfully');
            }else{
                return $this->respondWithError('Room not found');
            }
        }catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}

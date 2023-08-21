<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_by',
        'name',
        'description',
    ];

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function countOfRacks($room_id)
    {
        $roomDetails = RoomDetails::where('room_id', $room_id)->get();
        if($roomDetails->count() > 0){
            return $roomDetails->last()->rack;
        }else{
            return 0;
        }
    }
    public function countOfShelfs($room_id)
    {
        $shelfCount = 0;
        for ($index=0; $index < $this->countOfracks($room_id); $index++) { 
            $shelfCount += RoomDetails::where('room_id', $room_id)->where('rack', $index+1)->count();
        }
        return $shelfCount;
    }
}

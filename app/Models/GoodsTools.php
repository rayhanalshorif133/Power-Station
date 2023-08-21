<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsTools extends Model
{
    use HasFactory;

    protected $table = 'goods_tools';

    protected $fillable = [
        'device_id',
        'added_by',
        'room_details_id',
        'image',
        'description',
    ];


    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
    public function stock()
    {
        return $this->belongsTo(DeviceStock::class,'device_id');
    }

    public function roomDetails()
    {
        return $this->belongsTo(RoomDetails::class, 'room_details_id');
    }

     public function createGoodsToolsHistoryLog($goodsToolsId, $message)
    {
        $goodsToolsLog = new GoodsToolsLog();
        $goodsToolsLog->goods_tools_id = $goodsToolsId;
        $goodsToolsLog->message = $message . ' -' . auth()->user()->name;
        $goodsToolsLog->date_time = date('Y-m-d H:i:s');
        $goodsToolsLog->save();
        return $goodsToolsLog;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsToolsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'goods_tools_id', 'message', 'date_time'
    ];

    protected $table = 'goods_tools_logs';


    public function goodsTools()
    {
        return $this->belongsTo(GoodsTools::class, 'goods_tools_id');
    }

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

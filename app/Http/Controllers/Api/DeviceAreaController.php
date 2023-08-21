<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceArea;
use Illuminate\Support\Facades\Validator;


class DeviceAreaController extends Controller
{
    public function fetchAll()
    {
        $deviceAreas = DeviceArea::select()->with('addedBy')->get();
        return $this->respondWithSuccess('Successfully fetch areas', $deviceAreas);
    }
    public function fetchAreaById($id)
    {
        $deviceArea = DeviceArea::select()->where('id', $id)->with('addedBy')->get();
        return $this->respondWithSuccess('Successfully fetch area', $deviceArea);
    }
}

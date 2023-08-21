<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceSection;
use Illuminate\Support\Facades\Validator;

class DeviceSectionController extends Controller
{
    public function fetchAll()
    {
        $deviceSections = DeviceSection::select()->with('addedBy')->get();
        return $this->respondWithSuccess('Successfully fetch sections', $deviceSections);
    }
    public function fetchAreaById($id)
    {
        $deviceSection = DeviceSection::select()->where('id', $id)->with('addedBy')->get();
        return $this->respondWithSuccess('Successfully fetch section', $deviceSection);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DeviceHistoryLog;
use Illuminate\Http\Request;
use DateTime;
use DateTimeZone;

class DeviceHistoryLogController extends Controller
{
    public function index()
    {
        $deviceHistoryLogs = DeviceHistoryLog::select()->with('device')->orderBy('id', 'desc')->get();

        foreach ($deviceHistoryLogs as $deviceHistoryLog) {
            $dt = new DateTime($deviceHistoryLog->date_time);
            $tz = new DateTimeZone('Asia/Dhaka'); // or whatever zone you're after
            $dt->setTimezone($tz);
            $deviceHistoryLog->date_time = $dt->format('Y-m-d H:i:s');
            $deviceHistoryLog->badge = "badge-soft-" . $this->getRandomBadge();
        }
        return view('device.logs.index', compact('deviceHistoryLogs'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\IssueHistoryLog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class IssueHistoryLogController extends Controller
{
    /*
      $issue = IssueHistoryLog::select('date_time')->where('issue_id', 1)->first();
        $dt = new DateTime($issue->date_time);
        $tz = new DateTimeZone('Asia/Dhaka'); // or whatever zone you're after
        $dt->setTimezone($tz);
        $date = $dt->format('Y-m-d H:i:s');
        dd($date);
    */
  
    public function multiDeleteIssueLogs(Request $request)
    {
        $ids = $request->issueLogsIds;
        IssueHistoryLog::whereIn('id', $ids)->delete();
        return $this->respondWithSuccess('Issue History Logs Deleted Successfully');
    }
}

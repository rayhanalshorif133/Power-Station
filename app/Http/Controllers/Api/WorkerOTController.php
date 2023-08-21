<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkerOT;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;

class WorkerOTController extends Controller
{
    public function fetch($id = null)
    {
        if ($id) {
            $workerOTs = WorkerOT::select()->where('id', $id)->with('addedBy','user')->get();
        }else{
            $workerOTs = WorkerOT::select()->with('addedBy','user')->get();
        }
        foreach ($workerOTs as $key => $workerOT) {
            $workerOTInfo = User::select('id', 'name')->where('id', $workerOT->user_id)->first();
            $workerOT->worker_id = $workerOTInfo->id;
            $workerOT->worker_name = $workerOTInfo->name;
            $workerOT->total_time = $this->getTotalTime($workerOT->user_id);
            $workerOT->workerOT_details = $this->getWorkerOTDetails($workerOT->user_id);
            unset($workerOT->added_by);
            unset($workerOT->addedBy);
            unset($workerOT->user);
            unset($workerOT->created_at);
            unset($workerOT->updated_at);
            unset($workerOT->user_id);
            unset($workerOT->status);
        }
        $workerOTs = $workerOTs->unique('worker_id');
        
        return $this->respondWithSuccess("Successfully fetch worker over time data",$workerOTs);
    }
    public function fetchFilter($filterName = null)
    {
        if($filterName){
            if($filterName == 'today' || $filterName == 'this-week' || $filterName == 'this-month'){
                $startOfWeek = date('Y-m-d', strtotime('monday this week'));
                $endOfWeek = date('Y-m-d', strtotime('sunday this week'));
                $startOfMonth = date('Y-m-01');
                $endOfMonth = date('Y-m-t');
                if ($filterName == 'today') {
                    $workerOTs = WorkerOT::select()->whereDate('created_at', date('Y-m-d'))->with('addedBy','user')->get();
                }elseif ($filterName == 'this-week') {
                    $workerOTs = WorkerOT::select()->whereBetween('created_at', [$startOfWeek, $endOfWeek])->with('addedBy','user')->get();
                }elseif ($filterName == 'this-month') {
                    $workerOTs = WorkerOT::select()->whereBetween('created_at', [$startOfMonth, $endOfMonth])->with('addedBy','user')->get();
                }else{
                    $workerOTs = WorkerOT::select()->with('addedBy','user')->get();
                }
            }else{
                return $this->respondWithError("Invalid filter name.Filter accepts only 'today' and 'this-week' and 'this-month'.");
            }
        }

       
        foreach ($workerOTs as $key => $workerOT) {
            $workerOTInfo = User::select('id', 'name')->where('id', $workerOT->user_id)->first();
            $workerOT->worker_id = $workerOTInfo->id;
            $workerOT->worker_name = $workerOTInfo->name;
            $workerOT->total_time = $this->getTotalTime($workerOT->user_id);
            $workerOT->workerOT_details = $this->getWorkerOTDetails($workerOT->user_id);
            unset($workerOT->added_by);
            unset($workerOT->addedBy);
            unset($workerOT->user);
            unset($workerOT->created_at);
            unset($workerOT->updated_at);
            unset($workerOT->user_id);
            unset($workerOT->status);
        }
        $workerOTs = $workerOTs->unique('worker_id');
        if(count($workerOTs) > 0){
            return $this->respondWithSuccess("Successfully fetch worker over time data",$workerOTs);
        }else{
            return $this->respondWithError("No data found.");
        }
    }

     public function store(Request $request)
    {

        
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'start_date_time' => 'required|date',
            'end_date_time' => 'required|date',
            'purpose' => 'required',
        ]);
        
        if ($validator->fails()) {
            return $this->respondWithError("User id , start date time , end date time and purpose are required");
        }

         try {
            $request->merge(['start_date_time' => date('Y-m-d H:i:s', strtotime($request->start_date_time))]);
            $request->merge(['end_date_time' => date('Y-m-d H:i:s', strtotime($request->end_date_time))]);
            $request->merge(['added_by' => auth()->user()->id]);
            $workerOT = WorkerOT::create($request->all());
            return $this->respondWithSuccess('Worker OT created successfully.', $workerOT);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
        
    }

    protected function getTotalTime($user_id)
    {
        $workerOTs = WorkerOT::select('start_date_time', 'end_date_time')->where('user_id', $user_id)->get();
        $sumOfTotalTime = 0;
        foreach ($workerOTs as $key => $workerOT) {
            $start_date_time = $workerOT->start_date_time;
            $end_date_time = $workerOT->end_date_time;
            $start_date_time = strtotime($start_date_time);
            $end_date_time = strtotime($end_date_time);
            if($end_date_time < $start_date_time){
                $total_time = $start_date_time - $end_date_time;
            }else{
                $total_time = $end_date_time - $start_date_time;
            }
            $total_time = $total_time / 60;
            $total_time = $total_time / 60;
            $sumOfTotalTime += $total_time;
        }
        
        
        
        $sumOfTotalTime = number_format((float)$sumOfTotalTime, 2, '.', '');
        return $sumOfTotalTime . ' h';
    }

    protected function getWorkerOTDetails($user_id)
    {
        $workerOTs = WorkerOT::select('start_date_time', 'end_date_time', 'purpose')->where('user_id', $user_id)->get();
        foreach ($workerOTs as $key => $workerOT) {
            $start_date_time = $workerOT->start_date_time;
            $end_date_time = $workerOT->end_date_time;
            $start_date_time = strtotime($start_date_time);
            $end_date_time = strtotime($end_date_time);
            if($end_date_time < $start_date_time){
                $total_time = $start_date_time - $end_date_time;
            }else{
                $total_time = $end_date_time - $start_date_time;
            }
            $total_time = $total_time / 60;
            $total_time = $total_time / 60;
            $total_time = number_format((float)$total_time, 2, '.', '');
            $workerOT->total_time = $total_time . ' h';
        }
        return $workerOTs;
    }
}

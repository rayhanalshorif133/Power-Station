<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkerOT;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Exception;



class WorkerOTController extends Controller
{
    public function index()
    {
        $workerOTs = WorkerOT::select()->with('addedBy','user')->get();
        $users = User::all('id', 'name');
        foreach ($workerOTs as $workerOT) {
            $workerOT->badge_start = "badge-soft-" . $this->getRandomBadge();
            $workerOT->badge_end = "badge-soft-" . $this->getRandomBadge();
            $workerOT->bg = "bg-" . $this->getRandomBadge();
        }
        return view('worker-ot.index', compact('workerOTs', 'users'));
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
            return $this->respondWithErrorWeb($validator->errors()->first());
        }
         try {
            $request->merge(['start_date_time' => date('Y-m-d H:i:s', strtotime($request->start_date_time))]);
            $request->merge(['end_date_time' => date('Y-m-d H:i:s', strtotime($request->end_date_time))]);
            $request->merge(['added_by' => auth()->user()->id]);
            $workerOT = WorkerOT::create($request->all());
            return $this->respondWithSuccessWeb('Worker OT created successfully.');
        } catch (\Exception $e) {
            return $this->respondWithErrorWeb($e->getMessage());
        }
        
    }
}

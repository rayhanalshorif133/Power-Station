<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Validator;


class RecommendationController extends Controller
{
    public function fetchRecommendation($id = null){
        if($id == null){
            $recommendations = Recommendation::select()->with('addedBy')
                ->orderBy('created_at', 'desc')
                ->get();
             foreach ($recommendations as $recommendation) {
                $recommendation->added_by = $recommendation->addedBy->name;
                unset($recommendation->created_at);
                unset($recommendation->updated_at);
                unset($recommendation->addedBy);
            }
        }else{
            $recommendations = Recommendation::select()->with('addedBy')
                ->where('id', $id)
                ->orderBy('created_at', 'desc')
                ->first();
                $recommendations->added_by = $recommendations->addedBy->name;
                unset($recommendations->created_at);
                unset($recommendations->updated_at);
                unset($recommendations->addedBy);
        }
        return $this->respondWithSuccess('Successfully fetched recommendation',$recommendations);
    }   

    
      public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:recommendations',
            'note' => 'required|string',
            'priority' => 'required|string|in:low,medium,high',
        ]);


        if ($validator->fails()) {
            return $this->respondWithError('Recommendation title aready exist or required also note and priority (low,medium,high) are required');
        }
        try {
            $recommendation = new Recommendation();
            $recommendation->title = $request->title;
            $recommendation->note = $request->note;
            $recommendation->priority = $request->priority;
            $recommendation->added_by = auth()->user()->id;
            $recommendation->save();
            $recommendation = Recommendation::select('id','title','note','priority','added_by')->with('addedBy')
                ->where('id', $recommendation->id)
                ->first();
                $recommendation->added_by = $recommendation->addedBy->name;
                unset($recommendation->addedBy);
            return $this->respondWithSuccess("Recommendation successfully created", $recommendation);
        } catch (\Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}

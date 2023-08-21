<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecommendationController extends Controller
{

    public function index()
    {
        $recommendations = Recommendation::select()->with('addedBy')
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($recommendations as $recommendation) {
            $recommendation->alert = "alert-" . $this->getRandomBadge();
        }

        return view('recommendation.index', compact('recommendations'));
    }

    public function fetchRecommendationById($id)
    {
        $recommendation = Recommendation::select()->where('id', $id)->first();
        return $this->respondWithSuccess("data", $recommendation);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:recommendations',
            'note' => 'required|string',
            'priority' => 'required|string|in:low,medium,high',
        ]);


        if ($validator->fails()) {
            return $this->respondWithErrorWeb($validator->errors()->first());
        }

        try {
            $recommendation = new Recommendation();
            $recommendation->title = $request->title;
            $recommendation->note = $request->note;
            $recommendation->priority = $request->priority;
            $recommendation->added_by = auth()->user()->id;
            $recommendation->save();
            return $this->respondWithSuccessWeb("Recommendation successfully created");
        } catch (\Exception $e) {
            return $this->respondWithErrorWeb($e->getMessage());
        }
    }
}

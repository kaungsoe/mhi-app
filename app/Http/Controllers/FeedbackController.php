<?php

namespace App\Http\Controllers;

use App\Models\FeedbackType;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    //
    public function getFeedbackTypes(Request $request) { 
        $types = FeedbackType::all();
        return $types;
    }

    public function submitFeedback(Request $request){
        $user = Auth::user();

        $user_id = $user->id;
        $feedbackTypeId = $request->input('feedback_type');
        $feedback_desc = $request->input('feedback');    

        //dd($user_id, $feedbackTypeId, $feedback_desc);
        $feedback = new Feedback();
        $feedback->user_id = $user_id;
        $feedback->feedback_type_id = $feedbackTypeId;
        $feedback->feedback = $feedback_desc;
        $feedback->save();

        return response()->json(['message' => 'Submitted Feedback successfully'], 200);
    }

    public function getFeedbacks(Request $request) { 
        // $user = Auth::user();

        // if ($user->role != 1) { 
        //     return response()->json(['message' => 'Not allowed'], 401);
        // }

        return Feedback::all();
    }

}

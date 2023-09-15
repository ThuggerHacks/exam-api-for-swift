<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(FeedbackRequest $request){
        $subject = $request->fsubject;
        $message = $request->fmessage;
        $eid = $request->exam_id;
        $uid = $request->user_id;

        $feedback = Feedback::create([
            "fsubject" => $subject,
            "fmessage" => $message,
            "exam_id" => $eid,
            "user_id" => $uid
        ]);

        return $feedback;
    }

    public function one($id = 0){
        return Feedback::find($id);
    }

    public function byExamId($eid = 0){
        $feed = Feedback::where("exam_id",$eid)->get();
        return $feed;
    }

    public function all(){
        return Feedback::get();
    }

    public function delete($id = 0) {
        $feed = Feedback::find($id);

        if(!$feed){
            return response()->json(["error" => "Houve um erro"]);
        }

        return $feed->delete();
    }
}

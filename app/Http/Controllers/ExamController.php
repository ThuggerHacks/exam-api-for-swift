<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamRequest;
use App\Models\Category;
use App\Models\Exam;
use App\Models\Instituition;
use App\Models\Subject;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index(ExamRequest $request){
        $title = $request->etitle;
        $desc = $request->edescription;
        $year = $request->eyear;
        $userId = $request->user_id;
        $iid = $request->iid;
        $cid = $request->cid;
        $sid = $request->sid;

        $downloadUrl = $request->file("edownload_url")->store("/public");

        $path = asset("storage".explode("public",$downloadUrl)[1]);
        
        $exam = Exam::create([
            "etitle" => $title,
            "edescription" => $desc,
            "eyear" => $year,
            "user_id" => $userId,
            "edownload_url" => $path,
            "iid" => $iid,
            "cid" => $cid,
            "sid" => $sid  
        ]);

        return $exam;
    }

    public function update(Request $request, $id = 0){
        $title = $request->etitle;
        $desc = $request->edescription;
        $year = $request->eyear;
        /*$userId = $request->user_id;
        $iid = $request->iid;
        $cid = $request->cid;
        $sid = $request->sid;*/
       // $downloadUrl = $request->file("edownload_url")->store("/public");

        $ee = Exam::find($id);

        if(!$ee){
            return response()->json(["error" => "Houve um erro"]);
        }

        $exam = $ee->update([
            "etitle" => $title == ""?$ee->etitle:$title,
            "edescription" => $desc == ""?$ee->edescription:$desc,
            "eyear" => $year == "" || $year == 0?$ee->eyear:$year
        ]);

        return $exam;
    }

    public function one($id = 0){
        return Exam::find($id);
    }

    public function all(){
        return Exam::get();
    }

    public function delete($id = 0){
        $ee = Exam::find($id);

        if(!$ee){
            return response()->json(["error" => "Houve um erro"]);
        }

        $resp = $ee->delete();


        return $resp;
    }

    //this function must be called onSubjectSelect
    public function get(Request $request){
        $year = $request->year;//2020/2022
        $subject = $request->subject;//MATH,PHYSICS
        $instituition = $request->instituition; //UEM,UZ
        $type = $request->type; //secondary school/university
        
        $typeFinder = Category::where("ctype",$type)->first();

        if(!$typeFinder){
            return response()->json(["error" => "Houve um erro"]);
        }

        $instituitionFinder = Instituition::where("ctype",$typeFinder->cid)
                                            ->where("iname",$instituition)
                                            ->first();

        if(!$instituitionFinder){
            return response()->json(["error" => "Houve um erro"]);
        }

        $subjectFinder = Subject::where("instituition_id",$instituitionFinder->iid)
                                    ->where("sname",$subject)
                                    ->first();
        if(!$subjectFinder){
            return response()->json(["error" => "Houve um erro"]);
        }

        $exam = Exam::where("sid",$subjectFinder->sid)
                            ->where("eyear",$year)
                            ->get();
    
        return $exam;

    }

    public function onCategorySelect(Request $request) {
        $cname = $request->cname;

        $categoryFinder = Category::where("ctype",$cname)
                                    ->first();

        if(!$categoryFinder){
            return response()->json(["error" => "Houve um erro"]);
        }

        $institution = Instituition::where("ctype",$categoryFinder->cid)->get();

        return $institution;
    }

    //on institution select, u gotta show the subjects and also the year
    public function onInstitutionSelect(Request $request) {
        $iname = $request->iname;

        $institutionFinder = Instituition::where("iname",$iname)
                                    ->first();

        if(!$institutionFinder){
            return response()->json(["error" => "Houve um erro"]);
        }

        $subject = Subject::where("instituition_id",$institutionFinder->iid)->get();

        return $subject;
    }

    public function userId($uid = 0){
        return Exam::where("user_id",$uid)->get();
    }

}

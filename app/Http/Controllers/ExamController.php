<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExamRequest;
use App\Models\Category;
use App\Models\Exam;
use App\Models\Instituition;
use App\Models\Subject;
use DB;
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
        return DB::select("SELECT tbl_exam.*,tbl_instituition.*,tbl_user.*, tbl_subject.*,tbl_category.* FROM tbl_exam,tbl_instituition,tbl_user,tbl_subject,tbl_category WHERE tbl_exam.iid = tbl_instituition.iid AND tbl_exam.sid = tbl_subject.sid AND tbl_exam.cid = tbl_category.cid AND tbl_exam.user_id = tbl_user.uid AND tbl_exam.eid = ? LIMIT 1",[$id])[0];
    }

    public function all(){
        return DB::select("SELECT tbl_exam.*,tbl_instituition.*,tbl_user.*, tbl_subject.*,tbl_category.* FROM tbl_exam,tbl_instituition,tbl_user,tbl_subject,tbl_category WHERE tbl_exam.iid = tbl_instituition.iid AND tbl_exam.sid = tbl_subject.sid AND tbl_exam.cid = tbl_category.cid AND tbl_exam.user_id = tbl_user.uid");
    }

    public function delete($id = 0){
        $ee = Exam::find($id);

        if(!$ee){
            return response()->json(["error" => "Houve um erro"]);
        }

        $resp = $ee->delete();


        return ["data" => $resp];
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


        return DB::select("SELECT tbl_exam.*,tbl_instituition.*,tbl_user.*, tbl_subject.*,tbl_category.* FROM tbl_exam,tbl_instituition,tbl_user,tbl_subject,tbl_category WHERE tbl_exam.iid = tbl_instituition.iid AND tbl_exam.sid = tbl_subject.sid AND tbl_exam.cid = tbl_category.cid AND tbl_exam.user_id = tbl_user.uid AND tbl_exam.sid = ? AND tbl_exam.eyear = ?",[$subjectFinder->sid,$year]);
    

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

    public function category(){
        return Category::get();
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
        return DB::select("SELECT tbl_exam.*,tbl_instituition.*,tbl_user.*, tbl_subject.*,tbl_category.* FROM tbl_exam,tbl_instituition,tbl_user,tbl_subject,tbl_category WHERE tbl_exam.iid = tbl_instituition.iid AND tbl_exam.sid = tbl_subject.sid AND tbl_exam.cid = tbl_category.cid AND tbl_exam.user_id = tbl_user.uid AND tbl_exam.user_id = ?",[$uid]);
    }

}

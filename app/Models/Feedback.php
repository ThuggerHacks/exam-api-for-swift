<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Feedback extends Model
{
    protected $table = "tbl_feedback";
    public $timestamps = false;
    protected $primaryKey = "fid";
    protected $fillable = [
        "fsubject",
        "fmessage",
        "user_id",
        "exam_id"   
    ];
}
<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Exam extends Model
{
    protected $table = "tbl_exam";
    public $timestamps = false;
    protected $primaryKey = "eid";
    protected $fillable = [
        "edownload_url",
        "etitle",
        "edescription",
        "user_id",
        "eyear",
        "sid",
        "iid",
        "cid"
    ];
}
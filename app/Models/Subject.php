<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Subject extends Model
{
    protected $table = "tbl_subject";
    public $timestamps = false;
    protected $primaryKey = "sid";
    protected $fillable = [
        "sname"
    ];
}
<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Instituition extends Model
{
    protected $table = "tbl_instituition";
    public $timestamps = false;
    protected $primaryKey = "iid";
    protected $fillable = [
        "iname",
        "ctype"   
    ];
}
<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class User extends Model
{
    protected $table = "tbl_user";
    public $timestamps = false;
    protected $primaryKey = "uid";
    protected $fillable = [
        "uname",
        "uemail",
        "upassword"    
    ];
}
<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Category extends Model
{
    protected $table = "tbl_category";
    public $timestamps = false;
    protected $primaryKey = "cid";
    protected $fillable = [
        "ctype"   
    ];
}
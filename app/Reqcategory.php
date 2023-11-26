<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reqcategory extends Model
{
    public $table = "reqcategorys";

    public $timestamps=false;
    
    protected $fillable = [
        "req_category"
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kbcategory extends Model
{
    public $table = "kbcategorys";

    public $timestamps=false;

    protected $fillable = [
        "kb_category"
    ];
}

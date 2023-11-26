<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $table = "statuss";

    public $timestamps=false;
    
    protected $fillable = [
        "status_label"
    ];
}

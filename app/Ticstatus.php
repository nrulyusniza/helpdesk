<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticstatus extends Model
{
    public $table = "ticstatuss";

    public $timestamps=false;

    protected $fillable = [
        "ticstatus_label"
    ];
}

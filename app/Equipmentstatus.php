<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipmentstatus extends Model
{
    public $table = "equipmentstatuss";

    public $timestamps=false;

    protected $fillable = [
        "equipmentstatus_label"
    ];
}

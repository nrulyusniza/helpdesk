<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipmentstatus extends Model
{
    public $table = "equipmentstatuss";

    public $timestamps=false;

    protected $fillable = [
        "assetstatus_label"
    ];

    public function equipmentstatus()
    {
        return $this->belongsTo(Equipmentstatus::class, 'equipmentstatus_id');
    }
}

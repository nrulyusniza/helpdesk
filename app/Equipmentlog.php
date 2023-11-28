<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Equipment;
use App\Equipmentstatus;

class Equipmentlog extends Model
{
    public $table = "equipmentlogs";

    protected $fillable = [
        "equipment_id", "asset_newlocation", "log_updatedat", "update_by", "equipmentstatus_id"
    ];

    protected $dates = ['log_updatedat'];

    // equipment_id
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    // equipmentstatus_id
    public function equipmentstatus()
    {
        return $this->belongsTo(Equipmentstatus::class, 'equipmentstatus_id');
    }
}

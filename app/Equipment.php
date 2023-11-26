<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Site;

class Equipment extends Model
{
    public $table = "equipments";

    public $timestamps=false;

    protected $fillable = [
        "asset_hostname", "asset_location", "asset_ip", "asset_type", "site_id"
    ];

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}

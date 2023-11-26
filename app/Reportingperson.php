<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Site;

class Reportingperson extends Model
{
    public $table = "reportingpersons";

    public $timestamps=false;

    protected $fillable = [
        "rptpers_name", "rptpers_phone", "rptpers_ext", "rptpers_mobile", "rptpers_email", "site_id"
    ];

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}

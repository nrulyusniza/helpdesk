<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public $table = "sites";

    public $timestamps=false;

    protected $fillable = [
        "site_name", "site_address", "site_abbreviation"
    ];
}

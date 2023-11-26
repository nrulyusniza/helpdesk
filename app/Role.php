<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\User;

class Role extends Model
{
    public $table = "roles";

    public $timestamps=false;

    protected $fillable = [
        "role_name", "role_desc"
    ];

    /*public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }*/
}

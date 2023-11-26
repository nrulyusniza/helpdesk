<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Type;
use App\Site;
use App\Reqcategory;
use App\Equipment;
use App\Status;
use App\Severity;
use App\Reporingperson;
use App\User;

class Issue extends Model
{
    public $table = "issues";

    protected $fillable = [
        "request_no", "request_type", "site_id", "reported_by", "phone_no", "reqcategory_id", "equipment_id",
        "attachment", "fault_description", "created_by", "create_date", "status_id", "admin_comments", "severity_id",
        "updated_by", "update_date"
    ];

    protected $dates = ['create_date', 'update_date'];

    // request_type
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    // site_id
    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    // reqcategory_id
    public function reqcategory()
    {
        return $this->belongsTo(Reqcategory::class, 'reqcategory_id');
    }

    // equipment_id
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    // status_id
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    // severity_id
    public function severity()
    {
        return $this->belongsTo(Severity::class, 'severity_id');
    }

    // reported_by, phone_no
    public function reportingperson()
    {
        return $this->belongsTo(Reportingperson::class, 'reportingperson_id');
    }

    // created_by
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // updated_by
    public function userr()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

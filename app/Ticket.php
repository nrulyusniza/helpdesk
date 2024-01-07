<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Issue;
use App\Type;
use App\Severity;
use App\Ticstatus;
use App\User;
use App\Ticketlog;

class Ticket extends Model
{
    public $table = "tickets";

    protected $fillable = [
        "request_id", "ticket_no", "ticket_type", "severity_id", "ticstatus_id", "report_received",
        "created_by", "create_date", "updated_by", "update_date"
    ];

    protected $dates = ['report_received', 'create_date', 'update_date'];

    public $timestamps=false;

    // request_id
    public function issue()
    {
        return $this->belongsTo(Issue::class, 'request_id');
    }

    // ticket_type
    public function type()
    {
        return $this->belongsTo(Type::class, 'ticket_type');
    }

    // severity_id
    public function severity()
    {
        return $this->belongsTo(Severity::class, 'severity_id');
    }

    // ticstatus_id
    public function ticstatus()
    {
        return $this->belongsTo(Ticstatus::class, 'ticstatus_id');
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

    public function ticketlog()
    {
        return $this->hasMany(Ticketlog::class);
    }

    public function latestTicketlog()
    {
        return $this->hasOne(Ticketlog::class)->latest('id');
    }
}

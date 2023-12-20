<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reaction;
use App\Ticstatus;
use App\Ticket;
use App\User;

class Ticketlog extends Model
{
    public $table = "ticketlogs";

    protected $fillable = [
        "date", "description", "ticket_id", "update_by", "response_date", "response_time",
        "reaction_id", "attachment", "ticstatus_id"
    ];

    protected $dates = ['date', 'response_date'];

    public $timestamps=false;

    // reaction_id
    public function reaction()
    {
        return $this->belongsTo(Reaction::class, 'reaction_id');
    }

    // ticstatus_id
    public function ticstatus()
    {
        return $this->belongsTo(Ticstatus::class, 'ticstatus_id');
    }

    // ticket_id
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    // update_by
    public function user()
    {
        return $this->belongsTo(User::class, 'update_by');
    }
}

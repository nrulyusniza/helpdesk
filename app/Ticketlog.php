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
        "reaction_id", "attachment", "log_status"
    ];

    protected $dates = ['date', 'response_date'];

    // reaction_id
    public function reaction()
    {
        return $this->belongsTo(Reaction::class, 'reaction_id');
    }

    // log_status
    public function ticstatus()
    {
        return $this->belongsTo(Ticstatus::class, 'log_status');
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

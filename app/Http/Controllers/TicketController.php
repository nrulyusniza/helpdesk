<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Equipment;
use App\Ticketlog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
  
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function allticket(Ticket $ticket)
    {
        // query if ticket type = 1; 1=Ticket
        // sort in desc order - the latest row data on the top of table
        // eager load the relationship between issue and site
        $tickets = Ticket::where('ticket_type', '1')->orderBy('ticket_no','desc')->with('issue.site')->get();
  
        return view('tickets.allticket', compact('tickets'));
    }

    public function allticketedit(Ticket $ticket)
    {
        // retrieve the ticket and its associated ticket logs
        $ticket = Ticket::with('ticketlog')->findOrFail($ticket->id);

        // pass the ticket data to the view
        return view('tickets.allticketedit', compact('ticket'));
    }

    public function allticketupdate(Request $request, Ticket $ticket)
    {
        // validate the request data
        $ticketlog = new Ticketlog();
        $ticketlog->description = $validateData['description'];

        // save the ticket log
        $ticket->ticketlog()->save($ticketLog);

        // redirect back
        return redirect()->route('tickets.allticketedit', $ticket->id)
                            ->with('success','Ticket Log created successfully');
    }

    public function allconsumable(Ticket $ticket)
    {
        // query if ticket type = 2; 2=Consumable
        // sort in desc order - the latest row data on the top of table
        // eager load the relationship between issue and site
        $tickets = Ticket::where('ticket_type', '2')->orderBy('ticket_no','desc')->with('issue.site')->get();
  
        return view('tickets.allconsumable', compact('tickets'));
    }

    public function allconsumableedit(Ticket $ticket)
    {
        // retrieve the ticket and its associated ticket logs
        $ticket = Ticket::with('ticketlog')->findOrFail($ticket->id);

        // pass the ticket data to the view
        return view('tickets.allconsumableedit', compact('ticket'));
    }

    public function allconsumableupdate(Request $request, Ticket $ticket)
    {
        // validate the request data
        $ticketlog = new Ticketlog();
        $ticketlog->description = $validateData['description'];

        // save the ticket log
        $ticket->ticketlog()->save($ticketLog);

        // redirect back
        return redirect()->route('tickets.allconsumableedit', $ticket->id)
                            ->with('success','Ticket Log created successfully');
    }

    //---------------------------------------------------------------------- SITE ADMIN ----------------------------------------------------------------------
    
    public function listticket(Ticket $ticket)
    {
        // filter the tickets based on the site_id of the logged in user
        // query if ticket type = 1; 1=Ticket
        // sort in desc order - the latest row data on the top of table
        // eager load the relationship between issue and site
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $tickets = Ticket::whereHas('issue.site', function($query) use ($site_id) {
                            $query->where('site_id', $site_id);
                            })
                            ->where('ticket_type', 1)
                            ->orderBy('ticket_no', 'desc')
                            ->get();
  
        return view('tickets.listticket', compact('tickets'));
    }

    public function listticketlog(Ticket $ticket)
    {
        // retrieve the ticket and its associated ticket logs
        $ticket = Ticket::with('ticketlog')->findOrFail($ticket->id);

        // pass the ticket data to the view
        return view('tickets.listticketlog', compact('ticket'));
    }

    public function listconsumable(Ticket $ticket)
    {
        // filter the tickets based on the site_id of the logged in user
        // query if ticket type = 2; 2=Consumable
        // sort in desc order - the latest row data on the top of table
        // eager load the relationship between issue and site
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $tickets = Ticket::whereHas('issue.site', function($query) use ($site_id) {
                            $query->where('site_id', $site_id);
                            })
                            ->where('ticket_type', 2)
                            ->orderBy('ticket_no', 'desc')
                            ->get();
  
        return view('tickets.listconsumable', compact('tickets'));
    }

    public function listconsumablelog(Ticket $ticket)
    {
        // retrieve the ticket and its associated ticket logs
        $ticket = Ticket::with('ticketlog')->findOrFail($ticket->id);

        // pass the ticket data to the view
        return view('tickets.listconsumablelog', compact('ticket'));
    }

    //---------------------------------------------------------------------- SITE USER ----------------------------------------------------------------------
    
    public function entireticket(Ticket $ticket)
    {
        // filter the tickets based on the site_id of the logged in user
        // query if ticket type = 1; 1=Ticket
        // sort in desc order - the latest row data on the top of table
        // eager load the relationship between issue and site
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $tickets = Ticket::whereHas('issue.site', function($query) use ($site_id) {
                            $query->where('site_id', $site_id);
                            })
                            ->where('ticket_type', 1)
                            ->orderBy('ticket_no', 'desc')
                            ->get();
  
        return view('tickets.entireticket', compact('tickets'));
    }

    public function entireticketlog(Ticket $ticket)
    {
        // retrieve the ticket and its associated ticket logs
        $ticket = Ticket::with('ticketlog')->findOrFail($ticket->id);

        // pass the ticket data to the view
        return view('tickets.entireticketlog', compact('ticket'));
    }

    public function entireconsumable(Ticket $ticket)
    {
        // filter the tickets based on the site_id of the logged in user
        // query if ticket type = 2; 2=Consumable
        // sort in desc order - the latest row data on the top of table
        // eager load the relationship between issue and site
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $tickets = Ticket::whereHas('issue.site', function($query) use ($site_id) {
                            $query->where('site_id', $site_id);
                            })
                            ->where('ticket_type', 2)
                            ->orderBy('ticket_no', 'desc')
                            ->get();
  
        return view('tickets.entireconsumable', compact('tickets'));
    }

    public function entireconsumablelog(Ticket $ticket)
    {
        // retrieve the ticket and its associated ticket logs
        $ticket = Ticket::with('ticketlog')->findOrFail($ticket->id);

        // pass the ticket data to the view
        return view('tickets.entireconsumablelog', compact('ticket'));
    }

    public function generatereport(Ticket $ticket)
    {
        // $loggedInUser = Auth::user();
        // $site_id = $loggedInUser->site->id;
        
        // $tickets = Ticket::where('site_id', $site_id)->orderBy('request_no','desc')->get();

        $tickets = Ticket::with('user')->get();

        return view('tickets.report.generatereport', compact('tickets'));
    }
}

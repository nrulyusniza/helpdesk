<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Equipment;
use App\Ticketlog;
use DB;
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

    //---------------------------------------------------------------------- SUPER ADMIN ----------------------------------------------------------------------

    public function allticket(Ticket $ticket)
    {
        // query if ticket type = 1; 1=Ticket
        // sort in desc order - the latest row data on the top of table
        // eager load the relationship between issue and site
        // $tickets = Ticket::where('ticket_type', '1')->orderBy('ticket_no','desc')->with('issue.site')->get();

        // $tickets = Ticket::select(
        //     'tickets.*',
        //     DB::raw('(SELECT ticstatus_id 
        //             FROM ticketlogs 
        //             WHERE ticketlogs.ticket_id = tickets.id 
        //             ORDER BY id DESC LIMIT 1) as current_status')
        // )
        // ->get();

        $tickets = Ticket::where('ticket_type', '1')
                            ->orderBy('ticket_no', 'desc')
                            ->with('issue.site', 'ticketlog.ticstatus')
                            ->get();
  
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
        // // validate the request data
        // $ticketlog = new Ticketlog();
        // // $ticketlog->description = $validateData['description'];

        // // save the ticket log
        // $ticket->ticketlog()->save($ticketlog);

        // $ticket->ticketlog()->create($request->all());

        // currently authenticated user
        $currentUpdateUser = auth()->user();

        // new ticket log entry with the update_by field set to the username of the authenticated user
        $newTicketLog = $ticket->ticketlog()->create([
            'date'      => now(), // current date and time
            'description' => $request->input('description'),
            'ticket_id' => $ticket->id,
            'update_by' => $currentUpdateUser->username,
            'response_date' => $request->input('response_date'),
            'response_time' => $request->input('response_time'),
            'reaction_id' => $request->input('reaction_id'),
            'attachment' => $request->input('attachment'),
            'ticstatus_id' => $request->input('ticstatus_id'),
        ]);

        $ticket->update([
            'ticstatus_id' => $newTicketLog->ticstatus_id,  // ticstatus_id in tickets table will regularly update
        ]);

        // redirect back
        return redirect()->route('tickets.allticketedit', $ticket->id)
                            ->with('success','Ticket Log created successfully');
    }

    public function allconsumable(Ticket $ticket)
    {
        // query if ticket type = 2; 2=Consumable
        // sort in desc order - the latest row data on the top of table
        // eager load the relationship between issue and site
        // $tickets = Ticket::where('ticket_type', '2')->orderBy('ticket_no','desc')->with('issue.site')->get();

        $tickets = Ticket::where('ticket_type', '2')
                            ->orderBy('ticket_no', 'desc')
                            ->with('issue.site', 'ticketlog.ticstatus')
                            ->get();
  
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
        // // validate the request data
        // $ticketlog = new Ticketlog();
        // $ticketlog->description = $validateData['description'];

        // // save the ticket log
        // $ticket->ticketlog()->save($ticketLog);

        // $ticket->ticketlog()->create($request->all());

        // currently authenticated user
        $currentUpdateUser = auth()->user();

        // new ticket log entry with the update_by field set to the username of the authenticated user
        $newTicketLog = $ticket->ticketlog()->create([
            'date'      => now(), // current date and time
            'description' => $request->input('description'),
            'ticket_id' => $ticket->id,
            'update_by' => $currentUpdateUser->username,
            'response_date' => $request->input('response_date'),
            'response_time' => $request->input('response_time'),
            'reaction_id' => $request->input('reaction_id'),
            'attachment' => $request->input('attachment'),
            'ticstatus_id' => $request->input('ticstatus_id'),
        ]);

        $ticket->update([
            'ticstatus_id' => $newTicketLog->ticstatus_id,  // ticstatus_id in tickets table will regularly update
        ]);

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

    //---------------------------------------------------------------------- REPORTING ----------------------------------------------------------------------

    public function producereport(Request $request, Ticket $ticket)
    {
        $tickets = Ticket::where('ticstatus_id', 4)->orderBy('report_received','desc')->with('issue.site')->get();

        if($request->ajax())
        {
            $data = Ticket::select('*');

            if($ticket->filled('from_date') && $ticket->filled('to_date'))
            {
                $data = $data->whereBetween('report_received', [$ticket->from_date, $ticket->to_date]);
            }

            return DataTables::of($data)->addIndexColumn()->make(true);
        }

        return view('tickets.report.producereport', compact('tickets'));
    }

    // public function producereport(Request $request, Ticket $ticket)
    // {
    //     $tickets = Ticket::where('ticstatus_id', 4)
    //         ->orderBy('report_received', 'desc')
    //         ->with('issue.site');
    
    //     // Check if start_date and end_date are provided in the request
    //     if ($request->has('start_date') && $request->has('end_date')) {
    //         $start_date = $request->input('start_date');
    //         $end_date = $request->input('end_date');
    
    //         // Filter tickets based on the selected date range
    //         $tickets->whereBetween('report_received', [$start_date, $end_date]);
    //     }
    
    //     $tickets = $tickets->get();
    
    //     return view('tickets.report.producereport', compact('tickets'));
    // }

    public function generatereport(Ticket $ticket)
    {
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site_id;

        $tickets = Ticket::whereHas('issue.site', function($query) use ($site_id) {
            $query->where('site_id', $site_id);
            })
            ->where('ticstatus_id', 4)
            ->get();

            

        return view('tickets.report.generatereport', compact('tickets'));
    }

    // public function generatereport(Request $request, Ticket $ticket)
    // {
    //     $loggedInUser = Auth::user();
    //     $site_id = $loggedInUser->site_id;

    //     $startDate = $request->input('start_date'); // assuming you have 'start_date' and 'end_date' in your form
    //     $endDate = $request->input('end_date');

    //     $tickets = Ticket::whereHas('issue.site', function($query) use ($site_id) {
    //             $query->where('site_id', $site_id);
    //         })
    //         ->where('ticstatus_id', 4)
    //         ->whereBetween('report_received', [$startDate, $endDate])
    //         ->get();

    //     return view('tickets.report.generatereport', compact('tickets'));
    // }
}

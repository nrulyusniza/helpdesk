<?php

namespace App\Http\Controllers;

use App\Issue;
use App\User;
use App\Site;
use App\Equipment;
use App\Reportingperson;
use App\Ticket;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issues = Issue::all();
  
        return view('issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        // $data['sites'] = Site::get(["asset_hostname", "id"]);
        // return view('issues.create', $data);

        return view('issues.create');
    }

    // public function fetchEquipment(Request $request)
    // {
    //     $data['equipments'] = Equipment::where("site_id", $request->site_id)
    //                             ->get(["site_name", "id"]);
  
    //     return response()->json($data);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'request_no' => 'required',
        ]);
  
        Issue::create($request->all());
   
        return redirect()->route('issues.index')
                        ->with('success','New Request created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        return view('issues.show', compact('issue'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        return view('issues.edit', compact('issue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        // $request->validate([
        //     'request_no' => 'required',
        // ]);
  
        $issue->update($request->all());
  
        return redirect()->route('issues.index')
                        ->with('success','Request updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        $issue->delete();

       return redirect()->route('issues.index')
                        ->with('success','Request deleted successfully');
    }

    //---------------------------------------------------------------------- SUPER ADMIN ----------------------------------------------------------------------

    public function allissue(Issue $issue)
    {
        // $issues = Issue::all();
        $issues = Issue::with('user')->get();

        // sort in desc order - the latest row data on the top of table
        $issues = Issue::orderBy('request_no','desc')->get();
  
        return view('issues.allissue', compact('issues'));
    }

    public function allissuedetail(Issue $issue)
    {  
        return view('issues.allissuedetail', compact('issue'));
    }

    public function allissuecreate()
    {
        return view('issues.allissuecreate');
    }

    public function allissuestore(Request $request)
    {
        // $request->validate([
        //     'request_no' => 'required',
        // ]);
  
        // Issue::create($request->all());

        // validate the request data as needed
        $requestData = $request->all();

        // add the currently authenticated user's username to the request data
        $requestData['created_by'] = Auth::user()->username;

        Issue::create($requestData);

        return redirect()->route('issues.allissue')
                        ->with('success','New Request created successfully.');

        // Issue::create([
        //     'equipment_id' => $request->input('equipment_id'),
        //     // Other fields from the form
        // ]);
       
        // return redirect()->route('issues.allissue')
        //                 ->with('success', 'New Request created successfully.');
    }

    // dropdown reportingperson_id selection based on site_id
    public function getReportingpersonBySite($siteId)
    {
        $reportingperson = Reportingperson::where('site_id', $siteId)->get();

        return response()->json($reportingperson);
    }

    // dropdown equipment_id selection based on site_id
    public function getEquipmentBySite($siteId)
    {
        $equipment = Equipment::where('site_id', $siteId)->get();

        return response()->json($equipment);
    }

    public function allresponse(Issue $issue)
    {
        return view('issues.allresponse', compact('issue'));
    }

    public function allresponseupdate(Request $request, Issue $issue)
    {
        // $issue->update($request->all());

        $request->validate([
            'admin_comments' => 'required|string',
            'severity_id' => 'required|integer',
            'update_date' => 'required|date',
            'status-radio' => 'required|integer',
        ]);
    
        // Update only the necessary fields
        $issue->update([
            'admin_comments' => $request->input('admin_comments'),
            'severity_id' => $request->input('severity_id'),
            'update_date' => $request->input('update_date'),
            'status_id' => $request->input('status-radio'),
            'updated_by' => Auth::user()->username,
        ]);

        // Check if the status_id is 2 or 3 to create a new row in the Tickets table
        if ($request->input('status-radio') == 2 || $request->input('status-radio') == 3) {
            $ticket = new Ticket();
            $ticket->request_id = $issue->id;
            
            // Determine ticket_no format based on ticket_type
            if ($request->input('status-radio') == 2) {
                // Ticket
                $ticket->ticket_no = 'TT-' . date('Y-m') . '-' . str_pad(Ticket::where('ticket_type', 1)->count() + 1, 6, '0', STR_PAD_LEFT);
                $ticket->ticket_type = 1; // Set ticket_type to 1 for Ticket
            } elseif ($request->input('status-radio') == 3) {
                // Consumable
                $ticket->ticket_no = 'CT-' . date('Y-m') . '-' . str_pad(Ticket::where('ticket_type', 2)->count() + 1, 6, '0', STR_PAD_LEFT);
                $ticket->ticket_type = 2; // Set ticket_type to 2 for Consumable
            }
            
            $ticket->severity_id = $issue->severity_id;
            $ticket->ticstatus_id = $request->input('status-radio') == 2 ? 1 : 1; // 
            $ticket->report_received = Carbon::now(); // Current date and time

            $ticket->save();
        }
  
        return redirect()->route('issues.allissue', $issue->id)
                        ->with('success','Admin Response updated successfully');
    }

    //---------------------------------------------------------------------- SITE ADMIN ----------------------------------------------------------------------

    public function listissue(Issue $issue)
    {
        // filter the tickets based on the site_id of the logged in user
        // sort in desc order - the latest row data on the top of table
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site->id;
        
        $issues = Issue::where('site_id', $site_id)->orderBy('request_no','desc')->get();

        return view('issues.listissue',compact('issues'));
    }

    public function listissuedetail(Issue $issue)
    {  
        // $loggedInUser = Auth::user();
        // $site_id = $loggedInUser->site->id;

        // $issue->load('createdByUser', 'updatedByUser');

        return view('issues.listissuedetail', compact('issue'));
    }

    public function listissuecreate()
    {
        return view('issues.listissuecreate', compact('issues'));
    }

    public function listissuestore(Request $request)
    {
        // $request->validate([
        //     'request_no' => 'required',
        // ]);
  
        // Issue::create($request->all());

        // validate the request data as needed
        $requestData = $request->all();

        // add the currently authenticated user's username to the request data
        $requestData['created_by'] = Auth::user()->username;

        Issue::create($requestData);
   
        return redirect()->route('issues.listissue')
                        ->with('success','New Request created successfully.');
    }

    //---------------------------------------------------------------------- SITE USER ----------------------------------------------------------------------

    public function entireissue(Issue $issue)
    {
        // filter the tickets based on the site_id of the logged in user
        // sort in desc order - the latest row data on the top of table
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site->id;
        
        $issues = Issue::where('site_id', $site_id)->orderBy('request_no','desc')->get();

        return view('issues.entireissue', compact('issues'));
    }

    public function entireissuedetail(Issue $issue)
    {  
        return view('issues.entireissuedetail', compact('issue'));
    }

    public function entireissuecreate()
    {
        return view('issues.entireissuecreate');
    }

    public function entireissuestore(Request $request)
    {
        // $request->validate([
        //     'site_id' => 'required',
        // ]);
  
        // Issue::create($request->all());

        // validate the request data as needed
        $requestData = $request->all();

        // add the currently authenticated user's username to the request data
        $requestData['created_by'] = Auth::user()->username;

        Issue::create($requestData);
   
        return redirect()->route('issues.entireissue')
                        ->with('success','New Request created successfully.');
    }
}

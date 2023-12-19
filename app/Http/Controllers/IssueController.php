<?php

namespace App\Http\Controllers;

use App\Issue;
use App\User;
use App\Site;
use App\Equipment;
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
        

        $data['sites'] = Site::get(["asset_hostname", "id"]);
        return view('issues.create', $data);
    }

    public function fetchEquipment(Request $request)
    {
        $data['equipments'] = Equipment::where("site_id", $request->site_id)
                                ->get(["site_name", "id"]);
  
        return response()->json($data);
    }

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

    public function allissue(Issue $issue)
    {
        // $issues = Issue::all();
        $issues = Issue::with('user')->get();

        // sort in desc order - the latest row data on the top of table
        $issues = Issue::orderBy('request_no','desc')->get();
  
        return view('issues.allissue', compact('issues'));
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
  
        Issue::create($request->all());
   
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

    public function entireissuecreate()
    {
        return view('issues.entireissuecreate');
    }

    public function entireissuestore(Request $request)
    {
        // $request->validate([
        //     'site_id' => 'required',
        // ]);
  
        Issue::create($request->all());
   
        return redirect()->route('issues.entireissue')
                        ->with('success','New Request created successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Reportingperson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportingpersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportingpersons = Reportingperson::all();
  
        return view('reportingpersons.index', compact('reportingpersons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reportingpersons.create');
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
            'rptpers_name' => 'required',
        ]);
  
        Reportingperson::create($request->all());
   
        return redirect()->route('reportingpersons.index')
                        ->with('success','New Reporting Person created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reportingperson  $reportingperson
     * @return \Illuminate\Http\Response
     */
    public function show(Reportingperson $reportingperson)
    {
        return view('reportingpersons.show', compact('reportingperson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reportingperson  $reportingperson
     * @return \Illuminate\Http\Response
     */
    public function edit(Reportingperson $reportingperson)
    {
        return view('reportingpersons.edit', compact('reportingperson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reportingperson  $reportingperson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reportingperson $reportingperson)
    {
        $request->validate([
            'rptpers_name' => 'required',
        ]);
  
        $reportingperson->update($request->all());
  
        return redirect()->route('Reportingpersons.index')
                        ->with('success','Reporting Person updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reportingperson  $reportingperson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reportingperson $reportingperson)
    {
        $reportingperson->delete();

       return redirect()->route('reportingpersons.index')
                        ->with('success','Reporting Person deleted successfully');
    }

    public function allreportingperson(Reportingperson $reportingperson)
    {
        $reportingpersons = Reportingperson::all();
  
        return view('reportingpersons.allreportingperson', compact('reportingpersons'));
    }

    //---------------------------------------------------------------------------------------------------------------------------

    public function rpadmin(Reportingperson $reportingperson)
    {
        $loggedInUser = Auth::user();

        $site_id = $loggedInUser->site->id;

        $reportingpersons = Reportingperson::where('site_id', $site_id)->get();

        return view('reportingpersons.rpadmin',compact('reportingpersons'));
    }

    public function rpadmincreate(Reportingperson $reportingperson)
    {
        return view('reportingpersons.rpadmincreate');
    }

    public function rpadminstore(Request $request)
    {
        $request->validate([
            'rptpers_name' => 'required',
        ]);
  
        Reportingperson::create($request->all());
   
        return redirect()->route('reportingpersons.rpadmin')
                        ->with('success','New Reporting Person created successfully.');
    }

    public function rpadminedit(Reportingperson $reportingperson)
    {
        return view('reportingpersons.rpadminedit', compact('reportingperson'));
    }

    public function rpadminupdate(Request $request, Reportingperson $reportingperson)
    {
        $request->validate([
            'rptpers_name' => 'required',
        ]);
  
        $reportingperson->update($request->all());
  
        return redirect()->route('reportingpersons.rpadmin')
                        ->with('success','Reporting Person updated successfully');
    }

    public function rpadmindestroy(Reportingperson $reportingperson)
    {
        $reportingperson->delete();

       return redirect()->route('reportingpersons.rpadmin')
                        ->with('success','Reporting Person deleted successfully');
    }

    //---------------------------------------------------------------------------------------------------------------------------

    public function entirereportingperson(Reportingperson $reportingperson)
    {
        $loggedInUser = Auth::user();

        $site_id = $loggedInUser->site->id;

        $reportingpersons = Reportingperson::where('site_id', $site_id)->get();

        return view('reportingpersons.entirereportingperson',compact('reportingpersons'));
    }

    public function entirereportingpersoncreate(Reportingperson $reportingperson)
    {
        return view('reportingpersons.entirereportingpersoncreate');
    }

    public function entirereportingpersonstore(Request $request)
    {
        $request->validate([
            'rptpers_name' => 'required',
        ]);
  
        Reportingperson::create($request->all());
   
        return redirect()->route('reportingpersons.entirereportingperson')
                        ->with('success','New Reporting Person created successfully.');
    }

    public function entirereportingpersonedit(Reportingperson $reportingperson)
    {
        return view('reportingpersons.entirereportingpersonedit', compact('reportingperson'));
    }

    public function entirereportingpersonupdate(Request $request, Reportingperson $reportingperson)
    {
        $request->validate([
            'rptpers_name' => 'required',
        ]);
  
        $reportingperson->update($request->all());
  
        return redirect()->route('reportingpersons.entirereportingperson')
                        ->with('success','Reporting Person updated successfully');
    }

    public function entirereportingpersondestroy(Reportingperson $reportingperson)
    {
        $reportingperson->delete();

       return redirect()->route('reportingpersons.entirereportingperson')
                        ->with('success','Reporting Person deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Ticstatus;
use Illuminate\Http\Request;

class TicstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticstatuss = Ticstatus::all();
  
        return view('ticstatuss.index', compact('ticstatuss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticstatuss.create');
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
            'ticstatus_label' => 'required',
        ]);
  
        Ticstatus::create($request->all());
   
        return redirect()->route('ticstatuss.allstatus')
                        ->with('success','New Ticket Status created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticstatus  $ticstatus
     * @return \Illuminate\Http\Response
     */
    public function show(Ticstatus $ticstatus)
    {
        return view('ticstatuss.show', compact('ticstatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticstatus  $ticstatus
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticstatus $ticstatus)
    {
        return view('ticstatuss.edit', compact('ticstatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticstatus  $ticstatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticstatus $ticstatus)
    {
        $request->validate([
            'ticstatus_label' => 'required',
        ]);
  
        $ticstatus->update($request->all());
  
        return redirect()->route('ticstatuss.allstatus')
                        ->with('success','Ticket Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticstatus  $ticstatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticstatus $ticstatus)
    {
        $ticstatus->delete();

        return redirect()->route('ticstatuss.allstatus')
                        ->with('success','Ticket Status deleted successfully');
    }

    public function allticstatus(Ticstatus $ticstatus)
    {
        $ticstatuss = Ticstatus::all();
  
        return view('ticstatuss.allticstatus', compact('ticstatuss'));
    }
}

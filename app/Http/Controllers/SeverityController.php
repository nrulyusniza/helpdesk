<?php

namespace App\Http\Controllers;

use App\Severity;
use Illuminate\Http\Request;

class SeverityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $severitys = Severity::all();
  
        return view('severitys.index', compact('severitys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('severitys.create');
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
            'severity_label' => 'required',
        ]);
  
        Severity::create($request->all());
   
        return redirect()->route('severitys.allseverity')
                        ->with('success','New Severity created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Severity  $severity
     * @return \Illuminate\Http\Response
     */
    public function show(Severity $severity)
    {
        return view('severitys.show', compact('severity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Severity  $severity
     * @return \Illuminate\Http\Response
     */
    public function edit(Severity $severity)
    {
        return view('severitys.edit', compact('severity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Severity  $severity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Severity $severity)
    {
        $request->validate([
            'severity_label' => 'required',
        ]);
  
        $severity->update($request->all());
  
        return redirect()->route('severitys.allseverity')
                        ->with('success','Severity updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Severity  $severity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Severity $severity)
    {
        $severity->delete();

       return redirect()->route('severitys.allseverity')
                        ->with('success','Severity deleted successfully');
    }

    public function allseverity(Severity $severity)
    {
        $severitys = Severity::all();
  
        return view('severitys.allseverity', compact('severitys'));
    }
}

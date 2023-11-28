<?php

namespace App\Http\Controllers;

use App\Equipmentstatus;
use Illuminate\Http\Request;

class EquipmentstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipmentstatuss = Equipmentstatus::all();
  
        return view('equipmentstatuss.index', compact('equipmentstatuss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipmentstatuss.create');
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
            'equipmentstatus_label' => 'required',
        ]);
  
        Equipmentstatus::create($request->all());
   
        return redirect()->route('equipmentstatuss.index')
                        ->with('success','New Equipment Status created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipmentstatus  $equipmentstatus
     * @return \Illuminate\Http\Response
     */
    public function show(Equipmentstatus $equipmentstatus)
    {
        return view('equipmentstatuss.show', compact('equipmentstatus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipmentstatus  $equipmentstatus
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipmentstatus $equipmentstatus)
    {
        return view('equipmentstatuss.edit', compact('equipmentstatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipmentstatus  $equipmentstatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipmentstatus $equipmentstatus)
    {
        $request->validate([
            'equipmentstatus_label' => 'required',
        ]);
  
        $equipmentstatus->update($request->all());
  
        return redirect()->route('equipmentstatuss.index')
                        ->with('success','Equipment Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipmentstatus  $equipmentstatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipmentstatus $equipmentstatus)
    {
        $equipmentstatus->delete();

        return redirect()->route('equipmentstatuss.index')
                        ->with('success','Equipment Status deleted successfully');
    }

    public function allequipmentstatus(Equipmentstatus $equipmentstatus)
    {
        $equipmentstatuss = Equipmentstatus::all();
  
        return view('equipmentstatuss.allequipmentstatus', compact('equipmentstatuss'));
    }
}

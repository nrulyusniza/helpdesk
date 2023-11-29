<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\Equipmentlog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = Equipment::all();
  
        return view('equipments.index', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('equipments.create');
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
            'asset_hostname' => 'required',
        ]);
  
        Equipment::create($request->all());
   
        return redirect()->route('equipments.index')
                        ->with('success','New Asset created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        return view('equipments.show', compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        return view('equipments.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'asset_hostname' => 'required',
        ]);
  
        $equipment->update($request->all());
  
        return redirect()->route('equipments.index')
                        ->with('success','Asset updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

       return redirect()->route('equipments.index')
       ->with('success','Asset deleted successfully');
    }

    public function allasset(Equipment $equipment)
    {
        $equipments = Equipment::all();
        /*$equipments = Equipment::paginate(10);*/
  
        return view('equipments.allasset', compact('equipments'));
    }

    public function allassetedit(Equipment $equipment)
    {
        // retrieve the equipment and its associated equipment logs
        $equipment = Equipment::with('equipmentlog')->findOrFail($equipment->id);

        // pass the equipment data to the view
        return view('equipments.allassetedit', compact('equipment'));
    }

    public function allassetupdate(Request $request, Equipment $equipment)
    {
        // validate the request data
        $equipmentlog = new Equipmentlog();
        // $equipmentlog->asset_newlocation = $validateData['asset_newlocation'];

        // save the equipment log
        $equipment->equipmentlog()->save($equipmentlog);

        // redirect back
        return redirect()->route('equipments.allassetedit', $equipment->id)
                            ->with('success','Equipment Log created successfully');
    }

    //---------------------------------------------------------------------- SITE ADMIN ----------------------------------------------------------------------
    
    public function listasset(Equipment $equipment)
    {
        $loggedInUser = Auth::user();

        $site_id = $loggedInUser->site->id;

        $equipments = Equipment::where('site_id', $site_id)->get();

        return view('equipments.listasset',compact('equipments'));
    }

    //---------------------------------------------------------------------- SITE USER ----------------------------------------------------------------------

    public function entireasset(Equipment $equipment)
    {
        $loggedInUser = Auth::user();

        $site_id = $loggedInUser->site->id;

        $equipments = Equipment::where('site_id', $site_id)->get();

        return view('equipments.entireasset',compact('equipments'));
    }

    public function entireassetlog(Equipment $equipment)
    {
        // $loggedInUser = Auth::user();

        // $site_id = $loggedInUser->site->id;

        // $equipments = Equipment::where('site_id', $site_id)->get();

        return view('equipments.entireassetlog',compact('equipments'));
    }
}

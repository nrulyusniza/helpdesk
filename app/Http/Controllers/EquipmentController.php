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

    //---------------------------------------------------------------------- SUPER ADMIN ----------------------------------------------------------------------

    public function allasset(Equipment $equipment)
    {
        // $equipments = Equipment::all();

        // $equipments = Equipment::with(['equipmentlog' => function ($query) {
        //     $query->latest()->limit(1);
        // }])->get();   
        
        $equipments = Equipment::with(['equipmentlog' => function ($query) {
            $query->latest('id')->limit(1); // Assuming your EquipmentLog has an 'id' column
        }])->get();
  
        return view('equipments.allasset', compact('equipments'));
    }

    public function allassetcreate()
    {
        return view('equipments.allassetcreate');
    }

    public function allassetstore(Request $request)
    {
        $request->validate([
            'asset_hostname' => 'required',
        ]);
  
        Equipment::create($request->all());
   
        return redirect()->route('equipments.allasset')
                        ->with('success','New Asset created successfully.');
    }

    public function allassetedit(Equipment $equipment)
    {
        return view('equipments.allassetedit', compact('equipment'));
    }

    public function allassetupdate(Request $request, Equipment $equipment)
    {  
        $equipment->update($request->all());
  
        return redirect()->route('equipments.allassetedit', ['equipment' => $equipment->id])
                        ->with('success','Asset updated successfully');
    }

    public function allassetlog(Equipment $equipment)
    {
        // retrieve the equipment and its associated equipment logs
        $equipment = Equipment::with('equipmentlog')->findOrFail($equipment->id);

        // pass the equipment data to the view
        return view('equipments.allassetlog', compact('equipment'));
    }

    public function allassetlogupdate(Request $request, Equipment $equipment)
    {
        // validate the request data
        $request->validate([
            'asset_newlocation' => 'required',
            'log_updatedat' => 'required|date',
            'equipmentstatus_id' => 'required|exists:equipmentstatuss,id',
        ]);

        // update the equipment log
        $equipment->equipmentlog()->create($request->all());

        // redirect back to the equipment log page with a success message
        return redirect()->route('equipments.allassetlog', ['equipment' => $equipment])
            ->with('success', 'Asset log updated successfully');
    }


    //---------------------------------------------------------------------- SITE ADMIN ----------------------------------------------------------------------
    
    public function listasset(Equipment $equipment)
    {
        $loggedInUser = Auth::user();
        $site_id = $loggedInUser->site->id;
        $equipments = Equipment::where('site_id', $site_id)->get();

        return view('equipments.listasset',compact('equipments'));
    }

    public function listassetlog(Equipment $equipment)
    {
        // retrieve the equipment and its associated equipment logs
        $equipment = Equipment::with('equipmentlog')->findOrFail($equipment->id);

        // pass the equipment data to the view
        return view('equipments.listassetlog', compact('equipment'));
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
        // retrieve the equipment and its associated equipment logs
        $equipment = Equipment::with('equipmentlog')->findOrFail($equipment->id);

        // pass the equipment data to the view
        return view('equipments.entireassetlog', compact('equipment'));
    }
}

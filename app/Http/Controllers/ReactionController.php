<?php

namespace App\Http\Controllers;

use App\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reactions = Reaction::all();
  
        return view('reactions.index', compact('reactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reactions.create');
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
            'response_type' => 'required',
        ]);
  
        Reaction::create($request->all());
   
        return redirect()->route('reactions.index')
                        ->with('success','New Response type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function show(Reaction $reaction)
    {
        return view('reactions.show', compact('reaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Reaction $reaction)
    {
        return view('reactions.edit', compact('reaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reaction $reaction)
    {
        $request->validate([
            'response_type' => 'required',
        ]);
  
        $reaction->update($request->all());
  
        return redirect()->route('reactions.index')
                        ->with('success','Response Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reaction $reaction)
    {
        $reaction->delete();

        return redirect()->route('reactions.index')
                        ->with('success','Response Type deleted successfully');
    }

    public function allresponsetype(Reaction $reaction)
    {
        $reactions = Reaction::all();
  
        return view('reactions.allresponsetype', compact('reactions'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Kbcategory;
use Illuminate\Http\Request;

class KbcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kbcategorys = Kbcategory::all();
  
        return view('kbcategorys.index', compact('kbcategorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kbcategorys.create');
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
            'kb_category' => 'required',
        ]);
  
        Kbcategory::create($request->all());
   
        return redirect()->route('kbcategorys.allkbcategory')
                        ->with('success','New Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kbcategory  $kbcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Kbcategory $kbcategory)
    {
        return view('kbcategorys.show', compact('kbcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kbcategory  $kbcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Kbcategory $kbcategory)
    {
        return view('kbcategorys.edit', compact('kbcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kbcategory  $kbcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kbcategory $kbcategory)
    {
        $request->validate([
            'kb_category' => 'required',
        ]);
  
        $kbcategory->update($request->all());
  
        return redirect()->route('kbcategorys.allkbcategory')
                        ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kbcategory  $kbcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kbcategory $kbcategory)
    {
        $kbcategory->delete();

       return redirect()->route('kbcategorys.allkbcategory')
       ->with('success','Category deleted successfully');
    }

    public function allkbcategory(Kbcategory $kbcategory)
    {
        $kbcategorys = Kbcategory::all();
  
        return view('kbcategorys.allkbcategory', compact('kbcategorys'));
    }
}

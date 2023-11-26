<?php

namespace App\Http\Controllers;

use App\Reqcategory;
use Illuminate\Http\Request;

class ReqcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reqcategorys = Reqcategory::all();
  
        return view('reqcategorys.index', compact('reqcategorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reqcategorys.create');
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
            'req_category' => 'required',
        ]);
  
        Reqcategory::create($request->all());
   
        return redirect()->route('reqcategorys.index')
                        ->with('success','New Request Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reqcategory  $reqcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Reqcategory $reqcategory)
    {
        return view('reqcategorys.show', compact('reqcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reqcategory  $reqcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Reqcategory $reqcategory)
    {
        return view('reqcategorys.edit', compact('reqcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reqcategory  $reqcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reqcategory $reqcategory)
    {
        $request->validate([
            'req_category' => 'required',
        ]);
  
        $reqcategory->update($request->all());
  
        return redirect()->route('reqcategorys.index')
                        ->with('success','Request Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reqcategory  $reqcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reqcategory $reqcategory)
    {
        $reqcategory->delete();

       return redirect()->route('reqcategorys.index')
                        ->with('success','Request Category deleted successfully');
    }

    public function allreqcategory(Reqcategory $reqcategory)
    {
        $reqcategorys = Reqcategory::all();
  
        return view('reqcategorys.allreqcategory', compact('reqcategorys'));
    }
}

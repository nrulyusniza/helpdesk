<?php

namespace App\Http\Controllers;

use App\Ticketlog;
use Illuminate\Http\Request;

class TicketlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ticketlogs = Ticketlog::all();
  
        return view('ticketlogs.index', compact('ticketlogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticketlog  $ticketlog
     * @return \Illuminate\Http\Response
     */
    public function show(Ticketlog $ticketlog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticketlog  $ticketlog
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticketlog $ticketlog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticketlog  $ticketlog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticketlog $ticketlog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticketlog  $ticketlog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticketlog $ticketlog)
    {
        //
    }
}

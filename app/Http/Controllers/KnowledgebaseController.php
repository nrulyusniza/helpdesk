<?php

namespace App\Http\Controllers;

use App\Knowledgebase;
use Illuminate\Http\Request;

class KnowledgebaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $knowledgebases = Knowledgebase::all();
  
        return view('knowledgebases.index', compact('knowledgebases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('knowledgebases.create');
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
            'kb_title' => 'required',
        ]);
  
        Knowledgebase::create($request->all());
   
        return redirect()->route('knowledgebases.index')
                        ->with('success','New Knowledge Base created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Knowledgebase  $knowledgebase
     * @return \Illuminate\Http\Response
     */
    public function show(Knowledgebase $knowledgebase)
    {
        return view('knowledgebases.show', compact('knowledgebase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Knowledgebase  $knowledgebase
     * @return \Illuminate\Http\Response
     */
    public function edit(Knowledgebase $knowledgebase)
    {
        return view('knowledgebases.edit', compact('knowledgebase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Knowledgebase  $knowledgebase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Knowledgebase $knowledgebase)
    {
        $request->validate([
            'kb_title' => 'required',
        ]);
  
        $knowledgebase->update($request->all());
  
        return redirect()->route('knowledgebases.index')
                        ->with('success','Knowledge Base updated successfully');
    }

    //---------------------------------------------------------------------- SUPER ADMIN ----------------------------------------------------------------------

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Knowledgebase  $knowledgebase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Knowledgebase $knowledgebase)
    {
        $knowledgebase->delete();

       return redirect()->route('knowledgebases.allknowledgebase')
       ->with('success','Knowledge Base deleted successfully');
    }

    public function allknowledgebase(Knowledgebase $knowledgebase)
    {
        $knowledgebases = Knowledgebase::all();
  
        return view('knowledgebases.allknowledgebase', compact('knowledgebases'));
    }

    public function allknowledgebasecreate()
    {
        return view('knowledgebases.allknowledgebasecreate');
    }

    public function allknowledgebasestore(Request $request)
    {
        $request->validate([
            'kb_category' => 'required',
            'kb_topic' => 'required',
            'kb_article' => 'required',
        ]);
  
        Knowledgebase::create($request->all());
   
        return redirect()->route('knowledgebases.allknowledgebase')
                        ->with('success','New Knowledge Base created successfully.');
    }

    public function allknowledgebaseedit(Knowledgebase $knowledgebase)
    {
        return view('knowledgebases.allknowledgebaseedit', compact('knowledgebase'));
    }

    public function allknowledgebaseupdate(Request $request, Knowledgebase $knowledgebase)
    {
        $request->validate([
            'kb_category' => 'required',
            'kb_topic' => 'required',
            'kb_article' => 'required',
        ]);
  
        $knowledgebase->update($request->all());
  
        return redirect()->route('knowledgebases.allknowledgebase')
                        ->with('success','Knowledge Base updated successfully');
    }

    //---------------------------------------------------------------------- SITE ADMIN ----------------------------------------------------------------------

    public function listknowledgebase(Knowledgebase $knowledgebase)
    {
        $knowledgebases = Knowledgebase::all();

        return view('knowledgebases.listknowledgebase',compact('knowledgebases'));
    }

    public function listknowledgebasecreate()
    {
        return view('knowledgebases.listknowledgebasecreate');
    }

    public function listknowledgebasestore(Request $request)
    {
        $request->validate([
            'kb_category' => 'required',
            'kb_topic' => 'required',
            'kb_article' => 'required',
        ]);
  
        Knowledgebase::create($request->all());
   
        return redirect()->route('knowledgebases.listknowledgebase')
                        ->with('success','New Knowledge Base created successfully.');
    }

    public function listknowledgebaseedit(Knowledgebase $knowledgebase)
    {
        return view('knowledgebases.listknowledgebaseedit', compact('knowledgebase'));
    }

    public function listknowledgebaseupdate(Request $request, Knowledgebase $knowledgebase)
    {
        $request->validate([
            'kb_category' => 'required',
            'kb_topic' => 'required',
            'kb_article' => 'required',
        ]);
  
        $knowledgebase->update($request->all());
  
        return redirect()->route('knowledgebases.listknowledgebase')
                        ->with('success','Knowledge Base updated successfully');
    }
    
    //---------------------------------------------------------------------- SITE USER ----------------------------------------------------------------------

    public function entireknowledgebase(Knowledgebase $knowledgebase)
    {
        $knowledgebases = Knowledgebase::all();

        return view('knowledgebases.entireknowledgebase',compact('knowledgebases'));
    }

    public function entireknowledgebasecreate()
    {
        return view('knowledgebases.entireknowledgebasecreate');
    }

    public function entireknowledgebasestore(Request $request)
    {
        $request->validate([
            'kb_category' => 'required',
            'kb_topic' => 'required',
            'kb_article' => 'required',
        ]);
  
        Knowledgebase::create($request->all());
   
        return redirect()->route('knowledgebases.entireknowledgebase')
                        ->with('success','New Knowledge Base created successfully.');
    }

    public function entireknowledgebaseedit(Knowledgebase $knowledgebase)
    {
        return view('knowledgebases.entireknowledgebaseedit', compact('knowledgebase'));
    }

    public function entireknowledgebaseupdate(Request $request, Knowledgebase $knowledgebase)
    {
        $request->validate([
            'kb_category' => 'required',
            'kb_topic' => 'required',
            'kb_article' => 'required',
        ]);
  
        $knowledgebase->update($request->all());
  
        return redirect()->route('knowledgebases.entireknowledgebase')
                        ->with('success','Knowledge Base updated successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
  
        return view('users.alluser', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'fullname' => 'required',
        ]);
  
        User::create($request->all());
   
        return redirect()->route('users.alluser')
                        ->with('success','New User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'fullname' => 'required',
        ]);
  
        $user->update($request->all());
  
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

       return redirect()->route('users.index')
       ->with('success','User deleted successfully');
    }

    public function alluser(User $user)
    {
        $users = User::all();

        $totalUsers = DB::table('users')->count();
        $totalSuperAdmin = DB::table('users')->where('role_id', '1')->count();
        $totalSiteAdmin = DB::table('users')->where('role_id', '2')->count();
        $totalSiteUser = DB::table('users')->where('role_id', '3')->count();

        return view('users.alluser', compact('users', 'totalUsers', 'totalSuperAdmin', 'totalSiteAdmin', 'totalSiteUser'));
    }
}

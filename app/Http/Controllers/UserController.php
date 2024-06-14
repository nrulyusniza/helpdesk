<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Support\Facades\Hash;
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
            'username' => 'required|unique:users',
            'password' => 'required|string|min:8',
            'email' => 'required|email',
            'site_id' => 'required|exists:sites,id',
            'role_id' => 'required|exists:roles,id',
        ]);
  
        // User::create($request->all());

        $data = [
            'fullname' => $request->input('fullname'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'email' => $request->input('email'),
            'site_id' => $request->input('site_id'),
            'role_id' => $request->input('role_id'),
        ];
    
        User::create($data);
   
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
            'password' => 'nullable|string|min:8',
            'site_id' => 'required|exists:sites,id',
            'email' => 'required|email',
            'role_id' => 'required|exists:roles,id',
        ]);
  
        // $user->update($request->all());

        $data = [
            'fullname' => $request->input('fullname'),
            'site_id' => $request->input('site_id'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
        ];
    
        // check if a new password is provided and update it
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
    
        $user->update($data);
  
        return redirect()->route('users.alluser')
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

       return redirect()->route('users.alluser')
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

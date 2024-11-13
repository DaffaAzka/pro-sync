<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
           'name' => 'string|required',
           'email' => 'required|string',
           'password' => 'required|string',
           'repeat_password' => 'required|string'
        ]);

//        Check if password and confirm ps not have a same value
        if ($request->password != $request->repeat_password) {
            return redirect()->route('register')->with('error', 'Password and confirm Password must have same value!');
        }

//        Check if email already exist
        $user = User::where('email', "=", $request->email)->first();
        if ($user != null) {
            return redirect()->route('register')->with('error', 'Email already exist!');
        }

        User::create($request->all());
        return redirect()->route('login')->with('success', 'Create user success!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

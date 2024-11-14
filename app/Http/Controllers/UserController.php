<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Random\RandomException;

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
     * @throws RandomException
     */
    public function store(Request $request)
    {
        $auth = new AuthController();
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
        return $auth->verifyEmail($request, $request->email);
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
        $request->validate([
            'name' => 'string|required',
            'email' => 'required|string',
        ]);

        $user = auth()->guard('api')->user();

        $img = $user->profile_img;

        if ($request->hasFile('img')) {
            if ($img) {
                Storage::delete('profile/'.$img);
            }
            $file = $request->file('img');
            $filename = $this->generateRandomString();
            $extension = $file->getClientOriginalExtension();
            $img = $filename . "." . $extension;
            $allowed  = ['jpg', 'jpeg', 'png', 'jfif'];

            if (in_array($extension, $allowed)) {
                Storage::disk('public')->putFileAs('profile', $file, $img);
                $user->profile_img = $img;
            } else {
                return redirect()->route('register')->with('error', 'We not support that image format !');
            }
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function generateRandomString($length = 30): string
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
}

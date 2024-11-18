<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->guard('api')->user();
        $partners = User::whereIn('id', Partner::where('partner_id', $user->id)->where('status', 'pending')->pluck('user_id'))
            ->get() ->makeHidden(['password', 'created_at', 'updated_at']);
//        $partners = Partner::where('partner_id', $user->id)->where('status', 'pending')->get();

//        dd($partners);

        return view('partners.request', [
            'user' => [
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg'
            ],
            'partners' => $partners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Accept or Decline partner Request
     */
    function responsePartners(Request $request, string $username)
    {
        $user = auth()->guard('api')->user();
        $user2 = User::where('username', $username)->first();

        $partner = Partner::where('user_id', $user2->id)->where('partner_id', $user->id)->where('status', 'pending')->first();

        if ($partner) {
            $partner->status = 'partner';
            $partner->save();

            Partner::create([
                'user_id' => $user->id,
                'partner_id' => $user2->id,
                'status' => 'partner'
            ]);
        }

        return redirect()->to(route('request.index'))->with('success', [
            "message" => "You're now have a partner with",
            'username' => $username,
        ]);
    }
}

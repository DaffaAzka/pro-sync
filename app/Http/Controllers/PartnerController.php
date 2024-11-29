<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    function store(Request $request, $username)
    {
        $user =  auth()->guard('api')->user();
        $partnerId = User::where('username', $username)->value('id');
        $success = null;

        $request['user_id'] = $user->id;
        $request['partner_id'] = $partnerId;
        $request['status'] = "pending";

        if (!Partner::where('user_id', $user->id)->where('partner_id', $partnerId)->exists()) {
            $success = [
                'message' => "Successfully sending partner request to ",
                'username' => $username
            ];

            Partner::create($request->all());
        }

        return redirect()->to(route('partners.show'))->with('success', $success);
    }

    function show(Request $request)
    {
        $user =  auth()->guard('api')->user();
        $connects = [];
        $partners = $user->partners()->wherePivot('status', "partner")->latest()->paginate(4)->withQueryString();

        /**
         * Note: Carikan saya data user yang memiliki user_id yang sama dengan saya didalam table Partner dan ambil (pluck)
         *       user berdasarkan partner_id
         */
        $pending = User::whereIn('id', Partner::where('user_id', $user->id)->where('status', 'pending')
            ->orderBy('created_at', 'desc')->pluck('partner_id'))
            ->select('id', 'name', 'username', 'profile_img')
            ->latest()->paginate(4)->withQueryString();

        $page = [
            'partners' => true,
            'connect' => false,
            'pending' => false,
        ];

        if ($request['related']) {
            $partners = User::where('username', 'like', '%' . $request['related'] . '%')
                ->whereIn('id', Partner::where('user_id', $user->id)->pluck('partner_id')->toArray())
//                ->whereIn('id', Partner::where('user_id', $user->id)->select('partner_id')->get())
                ->select('id', 'name', 'username', 'profile_img')->latest()->paginate(4)->withQueryString();
        } else if($request['connect_to_partner']) {
            /**
             * Note: Carikan saya data user berdasarkan inputan yang mirip dengan username lalu ambil id nya dan
             *       seleksi berdasarkan yang tidak memiliki hubungan dengan id saya lalu ambil datanya
             */
            $connects = User::where('username', 'like', '%' . $request['connect_to_partner'] . '%')
                ->where('username', '!=', $user->username)
                ->whereNotIn('id', Partner::where('user_id', $user->id)->pluck('partner_id')->toArray())
                ->select('id', 'name', 'username', 'profile_img')->latest()->paginate(4)->withQueryString();

            $page = [
                'partners' => false,
                'connect' => true,
                'pending' => false,
            ];
        }

//        $dump = User::select('username')->get();
//        dd($this->getMyPartners());

        return view('partners.lists', [
            'user' => [
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg'
            ],
            'page' => $page,
            'partners' => $partners,
            'connects' => $connects,
            'pending' => $pending,
        ]);
    }

    function destroy($id)
    {

    }
}

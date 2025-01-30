<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class PageController extends Controller
{
    //

    function dashboard(Request $request)
    {
        $user =  auth()->guard('api')->user();

        /**
         *
         * Note: Carikan saya data di dalam tabel projects yang memiliki relasi dengan table
         *       projectMembers yang memiliki user_id yang sama dengan id saya, carikan yang
         *       deadlinenya paling dekat dan statusnya masing on going.
         */

        $project = Project::whereHas('projectMembers', function ($query) use ($user) {
            $query->where('user_id', "=", $user->id); }
        )->where('status', '=', 'ongoing')->orderByRaw('ABS(DATEDIFF(end_date, CURDATE()))')->first();

//        dd($project);

        $avatars = null;

        if ($project) {
            $avatars = User::whereHas('projectMembers', function ($query) use ($project) {
                $query->where('project_id', $project->id);
            })->get()->map(function ($user) {
                return $user->profile_img ?? 'guest.jpg';
            })->toArray();
        }

        return view('dashboard', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg'
            ],
            'project' => $project,
            'avatars' => $avatars
        ]);

    }

}

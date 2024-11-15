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

//        $project_member = ProjectMember::where('user_id', '=', $user->id)->get();
//        $project = null;
//
//        if ($project_member) {
//            for ($i = 0; $i < $project_member->count(); $i++) {
//                $project_temp = Project::findOrFail($project_member[$i]->project_id);
//                if ($i == 0) {
//                    $project = $project_temp;
//                } else {
//                    if ($project->end_date < $project_temp->end_date) {
//                        $project = $project_temp;
//                    }
//                }
//            }
//        }

        /**
         *
         * Note: Carikan saya data di dalam tabel projects yang memiliki relasi dengan table
         *       projectMembers yang memiliki user_id yang sama dengan id saya, carikan yang
         *       deadlinenya paling dekat dan statusnya masing on going.
         */

        $project = Project::whereHas('projectMembers', function ($query) use ($user) {
            $query->where('user_id', "=", $user->id); }
        )->where('status', '=', 'ongoing')->orderBy('end_date')->first();

        $avatars = User::whereHas('projectMembers', function ($query) use ($project) {
            $query->where('project_id', $project->id);
        })->get()->map(function ($user) {
            return $user->profile_img ?? 'guest.jpg';
        })->toArray();

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

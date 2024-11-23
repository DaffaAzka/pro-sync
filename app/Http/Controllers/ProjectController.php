<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd('masuk');
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:ongoing,completed',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $slug = $this->generateRandomString();
        $request['slug'] = $slug;
        $project = Project::create($request->all());

        $request['project_id'] = $project->id;
        $request['user_id'] = auth()->guard('api')->user()->id;
        $request['role'] = "master";

        ProjectMember::create($request->all());
        return redirect()->to('project/'.$slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = auth()->guard('api')->user();

        $project = Project::where('slug', '=', $id)->first();
        $members = ProjectMember::where('project_id', '=', $project->id)->get();

//        $partners = $user->partners()->whereNotIn('partners.partner_id',
//            \App\Models\Request::where('project_id', '=', $project->id)->pluck('receiver_id'))->get();

        $excludedPartnerIds = ProjectMember::where('project_id', $project->id)->pluck('user_id')
            ->merge(\App\Models\Request::where('project_id', $project->id)->pluck('receiver_id'));

        $partners = $user->partners() ->whereNotIn('partners.partner_id', $excludedPartnerIds)->get();
//        dd($partners);


//        dd($partners);

        return view('project.preview', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg',
                'role' => ProjectMember::where('project_id', '=', $project->id)->where('user_id', $user->id)
                    ->pluck('role')->first(),
            ],
            'project' => $project,
            'members_count' => $members->count(),
            'partners' => $partners,
        ]);
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

    function generateRandomString($length = 24): string
    {
        // Generate a random string
        $randomString = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);

        // Split the string into chunks of 4 characters
        $chunks = str_split($randomString, 4);

        // Join the chunks with a dash
        return implode('-', $chunks);
    }



}

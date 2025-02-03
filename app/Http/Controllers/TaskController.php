<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\Task;
use Illuminate\Http\Request;
use function Sodium\add;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $slug)
    {
        $user = auth()->guard('api')->user();
        $project = Project::where('slug', $slug)->first();
        $members = null;

        $projectMembers = $project->projectMembers->first(function ($member) use ($user) {
            return $member->user_id == $user->id;
        });

        if ($projectMembers->role == "master") {
            $tasks = Task::join('project_members', function ($join) {
                    $join->on('tasks.project_member_id', '=', 'project_members.id');
                })
                ->join('users', function ($join) {
                    $join->on('project_members.user_id', '=', 'users.id');
                })
                ->join('projects', function ($join) use ($project) {
                    $join->on('project_members.project_id', '=', 'projects.id')
                        ->where('projects.id', '=', $project->id);
                })
                ->select('tasks.*', 'users.name as assigned_to', 'project_members.role as assigned_role')
                ->orderBy('tasks.created_at')
                ->latest()
                ->paginate(5)
                ->withQueryString();

            $members = $project->projectMembers->map(function ($member) {
                $temp = $member->user->toArray();
                $temp['project_member_id'] = $member->id;
                return $temp;
            })->toArray();

        } else {
            $tasks = $project->tasks()
                ->where('project_member_id', $projectMembers->id)
                ->latest()
                ->paginate(6)
                ->withQueryString();

        }

        return view('tasks.lists', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg',
                'role' => $projectMembers->role,
                'username' => $user->username
            ],
            'tasks' => $tasks,
            'members' => $members,
            'projectMembers' => $projectMembers->id,
            'slug' => $slug,
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
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'due_date' => 'required'
        ]);

        $request['status'] = "ongoing";

//        dd($request);

        $task = Task::create($request->all());
//        dd($task);

        return redirect()->back()->with('success', [
            "message" => "Success create task for",
            "name" => $request['name'],
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show($slug, $id)
    {
        $user = auth()->guard('api')->user();
        $project = Project::where('slug', $slug)->first();
        $task = Task::findOrFail($id)->toArray();

        return view('tasks.preview', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg',
                'role' => ProjectMember::where('project_id', '=', $project->id)->where('user_id', $user->id)
                    ->pluck('role')->first(),
            ],
            'task' => $task,
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
}

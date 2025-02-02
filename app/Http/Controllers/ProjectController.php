<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\User;
use Carbon\Carbon;  // Keep only one Carbon import
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->guard('api')->user();

        if ($request['title']) {
            $projects = Project::whereHas('projectMembers', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->join('project_members', function ($join) use ($user) {
                    $join->on('projects.id', '=', 'project_members.project_id')->where('user_id', $user->id);
                })->where('name', 'LIKE', '%' . $request['title'] . '%')
                ->select('projects.*', 'project_members.role')->orderBy('projects.created_at')
                ->latest()->paginate(6)->withQueryString();
        } else {
//        Cari project yang memiliki projectMembers terkait dengan pengguna tertentu, setelah itu gabungkan
//        dengan role yang ada table ProjectMembers
            $projects = Project::whereHas('projectMembers', function ($query) use ($user) {
                $query->where('user_id', $user->id);})
                ->join('project_members', function ($join) use ($user) {
                    $join->on('projects.id', '=', 'project_members.project_id')
                        ->where('user_id', $user->id);
                })->select('projects.*', 'project_members.role')->orderBy('projects.created_at')
                ->latest()->paginate(6)->withQueryString();
        }

//        dd($projects);
        return view('project.lists', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg'
            ],
            'projects' => $projects,
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
        $projectMembers = $project->projectMembers->first(function ($member) use ($user) {
            return $member->user_id == $user->id;
        });

        $countMembers = ProjectMember::where('project_id', '=', $project->id)->count();
        $tasks = $project->tasks;

        $userTasks = $tasks->filter(function ($task) use ($projectMembers) {
            return $task->project_member_id == $projectMembers->id;
        });

        $userTaskCount = [
            'ongoing' => $userTasks->filter(function ($userTask) {
                return $userTask->status == "ongoing";
            })->count(),
            'completed' => $userTasks->filter(function ($userTask) {
                return $userTask->status == "completed";
            })->count(),
            'important' => $userTasks->filter(function ($userTask) {
                return $userTask->priority == "important" && $userTask->status == "ongoing";
            })->count(),
        ];

        $excludedPartnerIds = ProjectMember::where('project_id', $project->id)->pluck('user_id')
            ->merge(\App\Models\Request::where('project_id', $project->id)->pluck('receiver_id'));

        $partners = $user->partners() ->whereNotIn('partners.partner_id', $excludedPartnerIds)->get();

//        dd($this->groupCompletedTasksByMonthAndWeek($tasks, $projectMembers));

        return view('project.preview', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'profile' => $user->profile_img ?? 'guest.jpg',
                'role' => ProjectMember::where('project_id', '=', $project->id)->where('user_id', $user->id)
                    ->pluck('role')->first(),
                'count' => $userTaskCount
            ],
            'project' => $project,
            'chart' => $this->groupCompletedTasksByMonthAndWeek($tasks, $projectMembers),
            'members_count' => $countMembers,
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

    function groupCompletedTasksByMonthAndWeek($tasks, $projectMembers)
    {
        $result = [
            'user' => [],
            'other' => [],
            'month' => [],
            'count' => 0
        ];

        // Group tasks by user and others
        $userTasks = $tasks->filter(function ($task) use ($projectMembers) {
            return $task->project_member_id == $projectMembers->id && $task->status == 'completed';
        });

        $otherTasks = $tasks->filter(function ($task) use ($projectMembers) {
            return $task->project_member_id != $projectMembers->id && $task->status == 'completed';
        });

        // Get unique months and sort them chronologically
        $months = $tasks->map(function ($task) {
            return [
                'name' => Carbon::parse($task->due_date)->format('F'),
                'timestamp' => Carbon::parse($task->due_date)->startOfMonth()->timestamp
            ];
        })->unique('name')->sortBy('timestamp')->values();

        //  Set count of all tasks
        $result['count'] = $userTasks->count() + $otherTasks->count();

        // Store sorted month names
        $result['month'] = $months->pluck('name')->toArray();

        // Count tasks per month for user and others
        foreach ($result['month'] as $index => $month) {
            $result['user'][$index] = $userTasks->filter(function ($task) use ($month) {
                return Carbon::parse($task->due_date)->format('F') === $month;
            })->count();

            $result['other'][$index] = $otherTasks->filter(function ($task) use ($month) {
                return Carbon::parse($task->due_date)->format('F') === $month;
            })->count();
        }

        return $result;
    }




}

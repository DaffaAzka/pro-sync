<?php

namespace App\Http\Middleware;

use App\Models\Project;
use App\Models\ProjectMember;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateProjectAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $project = Project::where('slug', '=', $request->id)->first();
        $member = ProjectMember::where('project_id', '=', $project->id)->first();
        if ($member->user_id == auth()->guard('api')->user()->id) {
            return $next($request);
        }
        abort(404);
    }
}
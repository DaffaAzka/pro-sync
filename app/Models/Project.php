<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Project extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'start_date',
        'end_date',
    ];

    /**
     * Relationship between tables
     */

    function projectMembers(): HasMany
    {
        return $this->hasMany(ProjectMember::class, 'project_id', 'id');
    }

    function tasks(): HasManyThrough
    {
        return $this->hasManyThrough(Task::class, ProjectMember::class, 'project_id', 'project_member_id');
    }

}

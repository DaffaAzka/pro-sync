<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectMember extends Model
{
    //
    use HasFactory;

    protected $with = ['user'];

    protected $fillable = [
        'project_id',
        'user_id',
        'role',
    ];

    function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_member_id', 'id');
    }
}

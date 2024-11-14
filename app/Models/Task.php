<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    //
    use HasFactory;

    function projectMember(): BelongsTo
    {
        return $this->belongsTo(ProjectMember::class, 'project_member_id', 'id');
    }
}

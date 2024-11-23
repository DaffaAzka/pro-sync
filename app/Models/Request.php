<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    //

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'project_id',
        'status'
    ];
}

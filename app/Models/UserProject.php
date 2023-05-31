<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserProject extends Pivot
{
    use HasFactory;
    protected $table = 'user_project';

    protected $fillable = [
        'user_id',
        'project_id',
    ];
}

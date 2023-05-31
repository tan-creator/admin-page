<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projects extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'project';
    protected $fillable = [
        'name',
        'customer_name',
        'mm',
        'status',
        'types',
        'begin_date',
        'finish_date',
        'note'
    ];
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_project', 'project_id', 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'fullname',
        'code',
        'area_code',
        'phone_number',
        'day_of_birth',
        'address',
        'roles',
        'levels',
        'status',
        'types',
        'note',
        'department_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Interact with the user's first name.
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => $value !== '' ? Hash::make($value) : $value,
        );
    }

    /**
     * Get the department that owns the user.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function certifications(): BelongsToMany
    {
        return $this->belongsToMany(Certification::class, 'certification_user', 'user_id', 'certification_id');
    }
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Projects::class, 'user_project', 'user_id', 'project_id');
    }

    /**
     * Get the work logs for the blog post.
     */
    public function worklogs(): HasMany
    {
        return $this->hasMany(Worklog::class, 'email', 'email');
    }
}

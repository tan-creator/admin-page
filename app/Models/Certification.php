<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Certification extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'note',
        'granted',
    ];
    protected $table = 'certifications';

    public function users()
    {
        return $this->belongsToMany(User::class, 'certification_user', 'certification_id', 'user_id');
    }
}

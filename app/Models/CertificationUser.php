<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CertificationUser extends Pivot
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'certification_id',
        'user_id'
    ];
    protected $table = 'certification_user';
}

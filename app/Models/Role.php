<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'role_name',
        'guard_name',
    ];

    /**
     * Get the users associated with the role.
     */
    public function users(): HasMany
    {
        return $this->hasMany('App\Models\User', 'role_id', 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{
    /**
     * Attributes that are fillable through user actions.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'code',
        'status',
        'timezone',
        'created_by',
    ];

    /**
     * Get the users that belong to this family.
     */
    public function users(): ?HasMany
    {
        return $this->hasMany(User::class) ?? null;
    }
}

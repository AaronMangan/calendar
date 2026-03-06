<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frequency extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'description', 'is_active', 'is_default'
    ];
}

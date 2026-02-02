<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CalendarEvent extends Model
{
    protected $fillable = [
        'name', 'description', 'from', 'to', 'location', 'all_day',
        'is_public', 'status', 'user_id', 'family_id',
    ];

    public function type(): HasOne
    {
        return $this->hasOne(EventType::class) ?? null;
    }
}

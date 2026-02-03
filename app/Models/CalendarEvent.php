<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CalendarEvent extends Model
{
    protected $fillable = [
        'name', 'description', 'from', 'to', 'location', 'all_day',
        'is_public', 'status', 'user_id', 'family_id', 'key', 'event_type_id'
    ];

    /**
     * Return Event Type
     *
     * @return HasOne
     */
    public function event_type(): BelongsTo
    {
        return $this->belongsTo(EventType::class, 'event_type_id', 'id') ?? null;
    }
}

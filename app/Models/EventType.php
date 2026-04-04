<?php

namespace App\Models;

use App\Models\Family;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventType extends Model
{
    protected $fillable = ['name', 'color', 'description', 'icon', 'family_id', 'key', 'text_color'];

    /**
     * Return the family that owns this status.
     *
     * @return BelongsTo
     */
    protected function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }
}

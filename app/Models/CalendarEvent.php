<?php

namespace App\Models;

use Carbon\Carbon;
use Auth;
use App\Models\Frequency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CalendarEvent extends Model
{
    protected $fillable = [
        'title', 'description', 'from', 'to', 'location', 'all_day', 'is_recurring',
        'is_public', 'status', 'user_id', 'family_id', 'key', 'event_type_id', 'frequency_id'
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

    public function frequency(): BelongsTo
    {
        return $this->belongsTo(Frequency::class) ?? null;
    }

    /**
     * Returns all events that are occuring this month for the calendar view.
     *
     * @param Builder $query
     * @param integer $year
     * @param integer $month
     * @return Query $query
     */
    public function scopeForMonth(Builder $query, int $year, int $month)
    {
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth   = Carbon::create($year, $month, 1)->endOfMonth();

        return $query->where('from', '<=', $endOfMonth)
                    ->where('to', '>=', $startOfMonth);
    }

    public function scopeRecurring(Builder $query, int $year, int $month)
    {
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth   = Carbon::create($year, $month, 1)->endOfMonth();

        return CalendarEvent::whereIsRecurring(1);
    }
}

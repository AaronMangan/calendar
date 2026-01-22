<?php

/**
 * Calendar Service.
 * 
 * Used for a range of items in the calendar application.
 * 
 * @author Aaron Mangan
 * @license MIT
 * @version 1.0.0
 */
namespace App\Services;

use Carbon\Carbon;

class CalendarService
{
    /**
     * The days of the week in our calendar
     */
    const DAYS_OF_WEEK = [
        'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
    ];

    /**
     * The current date being worked on.
     *
     * @var string|null
     */
    public ?string $date;

    /**
     * Constructor, initialises to the current date if none provided.
     */
    public function __construct(?string $date)
    {
        $this->date = Carbon::parse($date)->format('Y-m-d');
    }

    public function dateFormatted(): string
    {
        return Carbon::parse($this->date)->format('F j, Y');
    }

    public function events(): array
    {
        // Placeholder for future event fetching logic.
        return [];
    }
}
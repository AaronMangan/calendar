<?php

namespace App\Livewire\Calendar;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\CalendarEvent;
use Illuminate\Database\Eloquent\Collection;

class DayView extends Component
{
    /**
     * Date to be examined.
     *
     * @var string|null
     */
    public ?string $date;

    /**
     * The events for the month.
     */
    public ?Collection $events;

    /**
     * Runs when th component is created.
     *
     * @param string $date
     * @return void
     */
    public function mount(string $date)
    {
        $carbonObj = Carbon::parse($date);
        $this->events = CalendarEvent::with('event_type')->forMonth($carbonObj->format('Y'), $carbonObj->format('m'))->get();
        $this->events = $this->eventsForDay();
        $this->date = Carbon::parse($date)->format('F j, Y');
    }

    /**
     * Show the view.
     *
     * @return void
     */
    public function render()
    {
        return \Auth::user()->can('view calendar')
            ? view('livewire.calendar.day-view', 
                ['date' => $this->date ?? 'Unknown']
                )->layout('layouts.app')
            : redirect()->route('dashboard');
    }

    /**
     * Return to the calendar view.
     *
     * @return void
     */
    public function goBackToCalendar()
    {
        return redirect()->route('calendar');
    }

    /**
     * Get evenmts for a specific day.
     * 
     * @var Carbon $day - The day that events are retrieved for.
     */
    public function eventsForDay()
    {
        $day = Carbon::parse($this->date);
        $startOfDay = $day->copy()->startOfDay();
        $endOfDay   = $day->copy()->endOfDay();
        return $this->events->load('event_type')->filter(function ($event) use ($startOfDay, $endOfDay) {
            return $event->from <= $endOfDay
                && $event->to   >= $startOfDay;
        });
    }
}

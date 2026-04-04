<?php

namespace App\Livewire\Calendar;

use App\Models\CalendarEvent;
use Carbon\Carbon;
use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Calendar extends Component
{
    /**
     * The current date the calendar is populating.
     * 
     * @var string
     */
    public ?string $incrementDate = null;
    
    /**
     * Current Month as a Carbon object.
     *
     * @var Carbon
     */
    public Carbon $currentMonth;

    /**
     * The events for the month.
     */
    public ?Collection $events;

    /**
     * Runs when the component is added to the DOM
     *
     * @return void
     */
    public function mount()
    {
        $this->currentMonth = now()->setTimezone(auth()->user()?->family?->timezone)->startOfMonth();
        $this->events = $this->getEventsForMonth(now()->toLocal()->format('Y'), now()->format('m'));
    }

    /**
     * Go to the previous month.
     *
     * @return void
     */
    public function previousMonth()
    {
        $this->currentMonth = $this->currentMonth->copy()->subMonth();
    }

    /**
     * Go to the next month.
     *
     * @return void
     */
    public function nextMonth()
    {
        $this->currentMonth = $this->currentMonth->copy()->addMonth();
    }

    /**
     * Get all days to be displayed in the calendar view.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getDaysProperty()
    {
        /**
         | Important: This method calculates the days to be displayed in the calendar view. 
         | It starts from the first day of the current month. Carbon::SUNDAY is used to ensure the calendar starts on Sunday.
         */
        $start = $this->currentMonth->copy()->startOfMonth()->toLocal()->startOfWeek(Carbon::SUNDAY);
        $end   = $this->currentMonth->copy()->toLocal()->endOfMonth();

        $days = [];
        while ($start <= $end) {
            $days[] = $start->copy();
            $start->addDay();
        }

        $collected = collect($days);
        return $collected;
    }

    /**
     * Get the events for each day in a month. This is called when the month is changed.
     *
     * @param Carbon $day
     * @return void
     */
    public function eventsForDay(Carbon $day)
    {
        $startOfDay = $day->copy()->startOfDay();
        $endOfDay   = $day->copy()->endOfDay();
        $this->incrementDate = $day->format('Y-m-d');
        
        /* Return the events. */
        return $this->events->filter(function ($event) use ($startOfDay, $endOfDay) {
            return $event->from <= $endOfDay
                && $event->to   >= $startOfDay;
        });
    }

    /**
     * Runs when the component is rendered.
     *
     * @return void
     */
    public function render()
    {
        return Auth::user()->can('view calendar')
            ? view('livewire.calendar.calendar')->layout('layouts.app')
            : redirect()->route('dashboard');
    }

    /**
     * Gets the details for the specific day.
     *
     * @param Carbon $day
     * @return RedirectResponse
     */
    public function examineDay($day): RedirectResponse
    {
        $date = $this->currentMonth->copy()->toLocal()->day($day)->format('Y-m-d');
        return redirect()->route('calendar.day', ['date' => $date]);
    }

    /**
     * Returns all the events for the current month, as a collection.
     *
     * @param string $year
     * @param string $month
     * @return Collection|null
     */
    public function getEventsForMonth(string $year, string $month): ?Collection
    {
        return CalendarEvent::forMonth($year, $month)->get();
    }
}

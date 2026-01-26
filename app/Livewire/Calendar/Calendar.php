<?php

namespace App\Livewire\Calendar;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Calendar extends Component
{
    /**
     * Current Month as a Carbon object.
     *
     * @var Carbon
     */
    public Carbon $currentMonth;

    /**
     * Runs when the component is added to the DOM
     *
     * @return void
     */
    public function mount()
    {
        $this->currentMonth = now()->startOfMonth();
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
        $start = $this->currentMonth->copy()->startOfMonth()->startOfWeek();
        $end   = $this->currentMonth->copy()->endOfMonth()->endOfWeek();

        $days = [];
        while ($start <= $end) {
            $days[] = $start->copy();
            $start->addDay();
        }

        return collect($days);
    }

    public function eventsForDay(Carbon $day)
    {
        // Placeholder for fetching events for the given day.
        // In a real application, you would fetch this from the database.
        if ($day->format('Y-m-d') == Carbon::now()->setTimezone('Australia/Brisbane')->format('Y-m-d')) {
            $events = [
                (object)['id' => 1, 'date' => now(), 'title' => 'Team Standup', 'type' => 'deadline'],
                (object)['id' => 2, 'date' => now(), 'title' => 'Lunch', 'type' => 'holiday'],
            ];
            return $events ?? [];
        } else {
            return [];
        }
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

    public function examineDay($day)
    {
        $date = $this->currentMonth->copy()->day($day)->format('Y-m-d');
        return redirect()->route('calendar.day', ['date' => $date]);
    }
}

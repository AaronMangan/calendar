<?php

namespace App\Livewire\Calendar;

use Livewire\Component;
use Carbon\Carbon;

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

    /**
     * Runs when the component is rendered.
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.calendar.calendar')->layout('layouts.app');
    }
}

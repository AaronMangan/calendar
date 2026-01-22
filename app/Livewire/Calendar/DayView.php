<?php

namespace App\Livewire\Calendar;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class DayView extends Component
{
    /**
     * Date to be examined.
     *
     * @var string|null
     */
    public ?string $date;

    /**
     * Runs when th component is created.
     *
     * @param [type] $date
     * @return void
     */
    public function mount($date)
    {
        $this->date = Carbon::parse($date)->format('F j, Y');
    }

    /**
     * Show the view.
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.calendar.day-view', [
            'date' => $this->date ?? 'Unknown',
        ])->layout('layouts.app');
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
}

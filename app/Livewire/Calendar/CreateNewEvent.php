<?php

namespace App\Livewire\Calendar;

use Livewire\Component;

class CreateNewEvent extends Component
{
    public ?string $title = null;
    public ?string $start_date = null;
    public ?string $end_date = null;
    public ?string $start_time = null;
    public ?string $end_time = null;
    public ?string $description = null;
    public ?string $type = null;
    
    /**
     * Render the form.
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.calendar.create-new-event')
            ->layout('layouts.app');
    }

    /**
     * Return to calendar view.
     *
     * @return void
     */
    public function goBackToCalendar()
    {
        return redirect()->route('calendar');
    }
}

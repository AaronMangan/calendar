<?php

namespace App\Livewire\Calendar;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

use function Livewire\Volt\updated;

class CreateNewEvent extends Component
{
    public ?string $title = null;
    public ?string $start_date = null;
    public ?string $end_date = null;
    public ?string $start_time = null;
    public ?string $end_time = null;
    public ?string $description = null;
    public ?string $type = null;
    public ?string $frequency = null;
    public ?bool $all_day = false;
    public ?bool $is_public = false;
    public ?bool $recurring = false;
    
    const RECURRANCES = [
        [
            'id' => 'daily',
            'name' => 'Every Day',
        ],
        [
            'id' => 'weekly',
            'name' => 'Every Week',
        ],
        [
            'id' => 'fortnightly',
            'name' => 'Every Fortnight',
        ],
        [
            'id' => 'monthly',
            'name' => 'Every Month',
        ],
        [
            'id' => 'quarterly',
            'name' => 'Every Quarter',
        ],
        [
            'id' => 'yearly',
            'name' => 'Every Year',
        ],
    ];
    
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

    /**
     * Undocumented function
     *
     * @return void
     */
    public function createEvent(): void
    {
        $data = $this->validate($this->validationRules());
        dd($data);
        $event = EventCalendar::create([
            'title' => $this->title ?? null,
            'start_date' => $this->start_date ?? null,
            'start_time' => $this->start_time ?? null,
            'end_date' => $this->end_date ?? null,
            'end_time' => $this->end_time ?? null,
        ]);
    }

    /**
     * Copy from the start date.
     *
     * @return void
     */
    public function copyStartDate(): void
    {
        $this->end_date = $this?->start_date ?? null;
    }

    /**
     * Copy from the start time
     *
     * @return void
     */
    public function copyStartTime(): void
    {
        $this->end_time = $this?->start_time ?? null;
    }

    /**
     * Returns the validation rules for the new event.
     *
     * @return array
     */
    private function validationRules(): array
    {
        return [
            'title' => [
                'string', 'max:255', 'required'
            ],
            'start_date' => [
                'date', 'required', 'max:50'
            ],
            'start_time' => [
                'string', 'max:50', 'required'
            ],
            'end_date' => [
                'date', 'max:50', 'required'
            ],
            'end_time' => [
                'string', 'max:50', 'required'
            ],
            'description' => [
                'nullable', 'string', 'max:2000'
            ],
            'all_day' => [
                'nullable', 'boolean'
            ],
            'is_public' => [
                'nullable', 'boolean'
            ],           
        ];
    }
}

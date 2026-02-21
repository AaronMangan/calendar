<?php

namespace App\Livewire\Calendar;

use App\Enums\Frequencies;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use App\Models\CalendarEvent;

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
    public ?string $frequency_id = null;
    public ?bool $all_day = false;
    public ?bool $is_public = false;
    public ?bool $is_recurring = false;
    public ?bool $showRecurring = false;

    /**
     * Sets the recurrances. I am thinking about moving these to some sort of enum?
     */
    const RECURRANCES = [
        [
            'id' => Frequencies::DAILY->value,
            'name' => 'Every Day',
            'default' => true,
        ],
        [
            'id' => Frequencies::EVERY_BUSINESS_DAY->value,
            'name' => 'Every Business Day',
            'default' => false,
        ],
        [
            'id' => Frequencies::WEEKLY->value,
            'name' => 'Every Week',
            'default' => false,
        ],
        [
            'id' => Frequencies::FORTNIGHTLY->value,
            'name' => 'Every Fortnight',
            'default' => false,
        ],
        [
            'id' => Frequencies::MONTHLY->value,
            'name' => 'Every Month',
            'default' => false,
        ],
        [
            'id' => Frequencies::QUARTERLY->value,
            'name' => 'Every Quarter',
            'default' => false,
        ],
        [
            'id' => Frequencies::YEARLY->value,
            'name' => 'Every Year',
            'default' => false,
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
     * Undocumented function
     *
     * @return void
     */
    public function setRecurring()
    {
        $this->is_recurring = !$this->is_recurring;
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
        $event = CalendarEvent::create([
            'title' => $this->title ?? null,
            'from' => $this->start_date . ' ' . $this->start_time ?? null,
            'to' => $this->end_date . ' ' . $this->end_time ?? null,
            'is_recurring' => $this->is_recurring ?? false,
            'frequency_id' => $this->frequency_id ?? null,
            'user_id' => auth()->user()->id ?? null,
            'family_id' =>auth()->user()->family_id ?? null,
        ]);

        $event->exists()
            ? session()->flash('Event created successfully!')
            : null;
        
        response()->redirect('/calendar');
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
            'is_recurring' => [
                'nullable', 'boolean'
            ],
            'frequency_id' => [
                'nullable', 'required_if:is_recurring,true', new Enum(Frequencies::class)
            ],
        ];
    }
}

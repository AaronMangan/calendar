<?php

namespace App\Livewire\Calendar;

use App\Enums\Frequencies;
use Illuminate\Validation\Rules\Enum;
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
    public ?string $frequency_id = null;
    public ?bool $all_day = false;
    public ?bool $is_public = false;
    public ?bool $recurring = false;
    public ?bool $showRecurring = false;

    /**
     * Sets the recurrances. I am thinking about moving these to some sort of enum?
     */
    const RECURRANCES = [
        [
            'id' => Frequencies::DAILY,
            'name' => 'Every Day',
            'default' => true,
        ],
        [
            'id' => Frequencies::EVERY_BUSINESS_DAY,
            'name' => 'Every Business Day',
            'default' => false,
        ],
        [
            'id' => Frequencies::WEEKLY,
            'name' => 'Every Week',
            'default' => false,
        ],
        [
            'id' => Frequencies::FORTNIGHTLY,
            'name' => 'Every Fortnight',
            'default' => false,
        ],
        [
            'id' => Frequencies::MONTHLY,
            'name' => 'Every Month',
            'default' => false,
        ],
        [
            'id' => Frequencies::QUARTERLY,
            'name' => 'Every Quarter',
            'default' => false,
        ],
        [
            'id' => Frequencies::YEARLY,
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
        $this->recurring = !$this->recurring;
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
            'is_recurring' => $this->is_recurring ?? false,
            'frequency_id' => $this->frequency_id ?? null,
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
        // Setting up an array of values to check if frequency is a valid value.
        $vals = collect(self::RECURRANCES)->map(function ($f) {
            return $f['id'];
        })->values()->join(',');

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
            'recurring' => [
                'nullable', 'boolean'
            ],
            'frequency_id' => [
                'nullable', 'required_if:recurring,true', new Enum(Frequencies::class)
            ],
        ];
    }
}

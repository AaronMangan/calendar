<?php

namespace App\Livewire\Calendar;

use Livewire\Component;

class EventChip extends Component
{
    /**
     * Event data.
     *
     * @var object|null
     */
    public $event = null;

    /**
     * Type of chip
     *
     * @var string|null
     */
    public ?string $type = 'holiday';

    /**
     * Runs when the component is first created.
     *
     * @param [type] $event
     * @param [type] $type
     * @return void
     */
    public function mount($event = null, $type = null)
    {
        $this->event = $event;
        $this->type = $type;
    }

    /**
     * Runs when the component is rendered.
     *
     * @return void
     */
    public function render()
    {
        $this->type = $this->event?->type ?? 'meeting';
        return view('livewire.calendar.event-chip', [
            'event' => $this->event ?? [],
        ]);
    }

    /**
     * Set classes per chip type. This defines the colour of the chip
     *
     * @param string|null $type
     * @return string
     */
    public function classes(?string $type = 'personal'): string
    {
        return match ($type ?? $this->event?->type) {
            'meeting'  => ' text-black bg-teal-500 ',
            'personal' => ' text-black bg-cyan-500 ',
            'deadline' => ' text-black bg-purple-500 ',
            'holiday'  => ' text-black bg-violet-500 ',
            default    => ' text-black bg-sky-500 ',
        };
    }
}

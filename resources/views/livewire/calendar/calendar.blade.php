<div class="max-w-6xl mt-12 mx-auto p-6 bg-white rounded-lg shadow-md" id="content">
    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <x-primary-button wire:click="previousMonth" class="text-center">
            Previous
        </x-primary-button>

        <h2 class="text-base md:text-2xl font-bold font-italic text-black">
            {{ $currentMonth->format('F Y') }}
        </h2>

        <x-primary-button wire:click="nextMonth">
            Next
        </x-primary-button>
    </div>

    <!-- Weekday headers -->
    <div class="hidden md:grid grid-cols-7 text-center font-semibold border-b">
        @foreach (['Sun','Mon','Tue','Wed','Thu','Fri','Sat'] as $day)
            <div class="py-2 tracking wide">{{ $day }}</div>
        @endforeach
    </div>

    <!-- Calendar grid -->
    <div title="{{ $this->currentMonth->format('F Y') }}" class="grid grid-cols-1 md:grid-cols-7 grid-rows-5 border-l border-t">
        @foreach ($this->days as $day)
            <div class="h-32 border-r border-b p-2 
                {{ $day->month !== $currentMonth->month ? 'bg-gray-300 hidden md:block text-gray-500' : '' }}
                {{ $day->toLocal()->isToday() ? 'bg-blue-200 text-black' : '' }}
            ">
                <div class="text-base font-thin" wire.click="examineDay({{ $day?->day }})">
                    {{ $day?->day }}
                </div>
                <!-- Events placeholder -->
                <div class="mt-1 text-sm space-y-1">
                    @php
                        $events = collect($this->eventsForDay($day));
                        $visibleEvents = $events->take(3);
                        $remainingCount = $events->count() - 3;
                    @endphp

                    @foreach ($visibleEvents as $event)
                        @if($event?->id)
                            <livewire:calendar.event-chip 
                                :event="$event" 
                                :type="$event?->type" 
                                :key="$event?->id" 
                            />
                        @endif
                    @endforeach

                    @if ($remainingCount > 0)
                        <div class="text-xs text-gray-500">
                            +{{ $remainingCount }} more
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

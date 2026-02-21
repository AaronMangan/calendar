@php
    $colorClasses = function ($eventType) {
        return match ($eventType) {
            'meeting' => 'bg-green-500',
            'personal' => 'bg-blue-500',
            'medical' => 'bg-red-500',
            'task' => 'bg-sky-500',
            'appointment' => 'bg-slate-500',
            default => 'bg-purple-500',
        };
    };
@endphp
<div class="max-w-4xl mt-12 mx-auto p-6 bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="flex items center justify-between mb-4">
        <x-primary-button wire:click="goBackToCalendar" class="text-center">
            Back to Calendar
        </x-primary-button>

        <h2 class="text-2xl font-bold font-italic text-black">
            {{ $date }}
        </h2>
    </div>
    <!-- Events for the day -->
    <div class="mt-4">
        <h3 class="text-xl font-semibold mb-2">Events for {{ $date }}</h3>
        @foreach($this->eventsForDay() as $dayEvent)
            <div class="group relative flex items-start gap-6 p-6 transition-all duration-300 ease-in-out hover:bg-white/50 rounded-3xl border border-transparent hover:border-gray-100 hover:shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                <div class="flex flex-col items-center">
                    <span class="text-xs font-bold uppercase tracking-widest text-blue-600/80">
                        {{ \Carbon\Carbon::parse($dayEvent->from)->format('H:i') }}
                    </span>
                    <div class="w-px h-full mt-2 bg-gradient-to-b from-blue-500/50 to-transparent"></div>
                </div>

                <div class="flex-1">
                    <div class="flex items-start justify-between">
                        <div>
                            <h4 class="text-xl font-medium tracking-tight text-gray-900 group-hover:text-blue-600 transition-colors">
                                {{ $dayEvent->title }}
                            </h4>
                            
                            <div class="mt-2 flex gap-2">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-[{{ $dayEvent?->event_type?->color ?? 'gray-900' }}] text-white">
                                    {{ $dayEvent->event_type->key ?? 'N/A   ' }}
                                </span>
                                <span class="text-xs text-gray-400 font-medium self-center italic">
                                    — with Team Alpha
                                </span>
                            </div>
                        </div>

                        <button class="opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0 p-2 bg-white shadow-sm border border-gray-100 rounded-full hover:bg-blue-50 hover:text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="C12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/></svg>
                        </button>
                    </div>

                    @if($dayEvent->description)
                        <p class="mt-4 text-gray-500 leading-relaxed max-w-prose antialiased">
                            {{ $dayEvent->description }}
                        </p>
                    @endif

                    <div class="mt-6 flex items-center gap-4">
                        <div class="flex -space-x-2">
                            <img class="w-7 h-7 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=JD" alt="">
                            <img class="w-7 h-7 rounded-full border-2 border-white" src="https://ui-avatars.com/api/?name=AB" alt="">
                        </div>
                        <span class="text-xs font-semibold text-gray-400">2 participants</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

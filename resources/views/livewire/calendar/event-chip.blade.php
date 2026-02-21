@php
    $colorClasses = function ($eventType) {
        return match ($eventType) {
            'meeting' => 'bg-green-500 text-white',
            'personal' => 'bg-blue-500 text-white',
            'medical' => 'bg-red-500 text-white',
            'task' => 'bg-sky-500 text-white',
            'appointment' => 'bg-slate-500 text-white',
            default => 'bg-purple-500 text-white',
        };
    };
    $isAllDay = match ($event?->all_day) {
        true => ' w-full px-0',
        default => 'px-1'
    }
@endphp
<div class="h-5 rounded-md {$isAllDay} text-[10px] truncate flex items-center justify-center {{ $colorClasses($event?->event_type?->key) }} hover:cursor-pointer" wire:click="viewDay({{ $event }})">
    <p>{{ $event?->title ?? 'N/A' }}</p>
</div>

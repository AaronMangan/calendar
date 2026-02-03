@php
    $colorClasses = function ($eventType) {
        return match ($eventType) {
            'meeting' => 'bg-green-500',
            'personal' => 'bg-blue-500',
            'medical' => 'bg-red-500',
            'task' => 'bg-sky-500',
            default => 'bg-purple-500',
        };
    };
@endphp
<div class="h-5 rounded-md px-1 text-[10px] truncate flex items-center justify-center {{ $colorClasses($event?->event_type?->key) }}">
    <p>{{ $event?->name ?? 'N/A' }}</p>
</div>

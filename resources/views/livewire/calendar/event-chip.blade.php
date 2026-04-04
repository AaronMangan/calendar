@php
    $event = $event->load('event_type');
    $isAllDay = match ($event?->all_day) {
        true => ' w-full px-0',
        default => 'px-1'
    }
@endphp

<div title="{{ $event?->event_type?->name }}: {{ $event?->title }}" class="h-4 rounded-md {$isAllDay} text-[10px] truncate flex items-center justify-center hover:cursor-pointer" wire:click="viewDay({{ $event }})" style="
    background-color: {{ $event->event_type->color ?? '#828282' }};
    color: {{ $event->event_type->text_color ?? '#000' }};
">
    <p>{{ $event?->title ?? 'N/A' }}</p>
</div>

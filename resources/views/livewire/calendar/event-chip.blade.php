@php
    $style = match ($type ?? $this->event?->type) {
        'meeting'  => 'text-black bg-teal-500',
        'personal' => 'text-black bg-slate-500',
        'deadline' => 'text-white bg-purple-500',
        'holiday'  => 'text-white bg-green-500',
        default    => 'text-black bg-sky-500',
    };
@endphp
<div class="h-5 rounded-md px-1 text-[10px] truncate flex items-center justify-center {{ $style }}">
    <p>{{ $event?->title ?? 'N/A' }}</p>
</div>
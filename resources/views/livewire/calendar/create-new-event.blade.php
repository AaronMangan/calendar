@php
    $options = collect(self::RECURRANCES)->map(function ($r) {
        return $r;
    })->values()->toArray() ?? [];
    $types = collect(App\Models\EventType::where('family_id', '=', null)->orWhere('family_id', '=', auth()->user()->family_id)->get())->map(function ($t) {
        return $t;
    })->values()->toArray() ?? [];
@endphp
<div class="max-w-4xl p-2 mx-2 mt-2 bg-white rounded-lg shadow-md md:mt-12 md:p-6 md:mx-auto">
    <!-- Header -->
    <div class="flex justify-between mb-4 items center">
        <h2 class="px-2 text-base font-bold text-black md:text-2xl md:px-0 font-italic">
            Create New Event
        </h2>
    </div>

    <!-- Event Creation Form -->
    <form wire:submit.prevent="createEvent" class="px-2 space-y-4 md:px-0" wire:loading.class="opacity-50">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
            <input type="text" id="title" wire:model="title" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm" > <!-- Requied -->
            @error('title')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col w-full md:space-x-4 md:space-y-2 md:flex-row">
            <div class="w-full md:mt-2">
                <label for="start_date" class="block w-full text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" id="start_date" :value="$this->start_date ?? old('start_date')" wire:model="start_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('start_date') is-invalid @enderror" > <!-- Requied -->
                @error('start_date')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full">
                <label for="start_time" class="block w-full text-sm font-medium text-gray-700">Start Time</label>
                <input type="time" id="start_time" wire:model="start_time" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm" >
                @error('start_time')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full">
                <div class="flex flex-row justify-between w-full">
                    <label for="end_date" class="flex flex-row justify-between w-full text-sm font-medium text-gray-700">End Date
                        <a wire:click="copyStartDate" class="text-[10px] text-blue-500 cursor-pointer">Use Start Date</a>
                    </label>
                </div>
                <input type="date" id="end_date" wire:model="end_date" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm" >
                @error('end_date')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full">
                <div class="flex flex-row justify-between w-full">
                    <label for="end_date" class="flex flex-row justify-between w-full text-sm font-medium text-gray-700">End Time
                        <a wire:click="copyStartTime" class="text-[10px] text-blue-500 cursor-pointer">Use Start Time</a>
                    </label>
                </div>
                <input type="time" id="end_time" wire:model="end_time" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm" >
                @error('end_date')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" wire:model="description" class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm"></textarea>
            @error('description')
                <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col justify-between w-full h-auto md:flex-row md:items-center">
            <div class="w-full md:w-1/3">
                <x-toggle id="is_public" label="Public Event?" name="is_public" wire:model="is_public" wire:loading.class="opacity-50 pointer-events-none"></x-toggle>
                @error('is_public')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/3">
                <x-toggle id="all_day" label="All Day?" name="all_day" wire:model="all_day" wire:loading.class="opacity-50 pointer-events-none"></x-toggle>
                @error('all_day')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/3">
                <x-toggle id="recurring" label="Recurring?" onchange="setRecurring" wire:model.live="recurring" wire:loading.class="opacity-50 pointer-events-none"></x-toggle>
                @error('recurring')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full pr-1 md:w-1/2 md:pr-4">
                <x-select parentClass="w-full" id="event_type_id" xModel="event_type_id" name="event_type_id" valueProp="id" class="w-full border-gray-300 rounded-lg" :label="'Select Event Type'" :options="$types"></x-select>
                @error('event_type_id')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Recurring Event --}}
        @if($this->is_recurring)
            <div class="flex flex-col justify-start w-full h-auto md:flex-row md:items-center">
                <div class="w-full pr-1 md:w-1/2 md:pr-4">
                    <x-select parentClass="w-full" id="frequency_id" xModel="frequency_id" name="frequency_id" class="w-full border-gray-300 rounded-lg" :label="'Select Frequency'" :options="$options"></x-select>
                </div>
                @error('frequency_id')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
        @endif
        <div class="flex justify-end">
            <x-primary-button type="submit">
                Create Event
            </x-primary-button>
        </div>
    </form>
</div>
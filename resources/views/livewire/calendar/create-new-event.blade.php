@php
    $options = collect(self::RECURRANCES)->map(function ($r) {
        return $r;
    })->values()->toArray() ?? [];
@endphp
<div class="max-w-4xl mt-2 md:mt-12 p-2 md:p-6 bg-white rounded-lg shadow-md mx-2 md:mx-auto">
    <!-- Header -->
    <div class="flex items center justify-between mb-4">
        <h2 class="text-base md:text-2xl px-2 md:px-0 font-bold font-italic text-black">
            Create New Event
        </h2>
    </div>

    <!-- Event Creation Form -->
    <form wire:submit.prevent="createEvent" class="space-y-4 px-2 md:px-0" wire:loading.class="opacity-50">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
            <input type="text" id="title" wire:model="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" > <!-- Requied -->
            @error('title')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex md:space-x-4 md:space-y-2 flex-col md:flex-row w-full">
            <div class="w-full md:mt-2">
                <label for="start_date" class="block text-sm font-medium text-gray-700 w-full">Start Date</label>
                <input type="date" id="start_date" :value="$this->start_date ?? old('start_date')" wire:model="start_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 @error('start_date') is-invalid @enderror" > <!-- Requied -->
                @error('start_date')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full">
                <label for="start_time" class="block text-sm font-medium text-gray-700 w-full">Start Time</label>
                <input type="time" id="start_time" wire:model="start_time" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" >
                @error('start_time')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full">
                <div class="w-full flex flex-row justify-between">
                    <label for="end_date" class="flex flex-row justify-between text-sm font-medium text-gray-700 w-full">End Date
                        <a wire:click="copyStartDate" class="text-[10px] text-blue-500 cursor-pointer">Use Start Date</a>
                    </label>
                </div>
                <input type="date" id="end_date" wire:model="end_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" >
                @error('end_date')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full">
                <div class="w-full flex flex-row justify-between">
                    <label for="end_date" class="flex flex-row justify-between text-sm font-medium text-gray-700 w-full">End Time
                        <a wire:click="copyStartTime" class="text-[10px] text-blue-500 cursor-pointer">Use Start Time</a>
                    </label>
                </div>
                <input type="time" id="end_time" wire:model="end_time" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" >
                @error('end_date')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" wire:model="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
            @error('description')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex h-auto w-full flex-col md:flex-row justify-between md:items-center">
            <div class="w-full md:w-1/3">
                <x-toggle id="is_public" label="Public Event?" name="is_public" wire:model="is_public" wire:loading.class="opacity-50 pointer-events-none"></x-toggle>
                @error('is_public')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/3">
                <x-toggle id="all_day" label="All Day?" name="all_day" wire:model="all_day" wire:loading.class="opacity-50 pointer-events-none"></x-toggle>
                @error('all_day')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="w-full md:w-1/3">
                <x-toggle id="recurring" label="Recurring?" onchange="setRecurring" wire:model.live="recurring" wire:loading.class="opacity-50 pointer-events-none"></x-toggle>
                @error('recurring')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Recurring Event --}}
        @if($this->is_recurring)
            <div class="flex h-auto w-full flex-col md:flex-row justify-start md:items-center">
                <div class="w-full md:w-1/2 pr-1 md:pr-4">
                    <x-select parentClass="w-full" id="frequency_id" xModel="frequency_id" name="frequency_id" class="w-full rounded-lg border-gray-300" :label="'Select Frequency'" :options="$options"></x-select>
                </div>
                @error('frequency_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
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
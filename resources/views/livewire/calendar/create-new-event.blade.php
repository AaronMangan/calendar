
<div class="max-w-4xl mt-12 mx-auto p-6 bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="flex items center justify-between mb-4">
        <x-primary-button wire:click="goBackToCalendar" class="text-center">
            Back to Calendar
        </x-primary-button>

        <h2 class="text-base md:
        text-2xl font-bold font-italic text-black">
            Create New Event
        </h2>
    </div>
    <!-- Event Creation Form -->
    <form wire:submit.prevent="createEvent" class="space-y-4">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Event Title</label>
            <input type="text" id="title" wire:model="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
        </div>
        <div class="flex md:space-x-4 flex-col md:flex-row w-full">
            <div class="w-full">
                <label for="start_date" class="block text-sm font-medium text-gray-700 w-full">Start Date</label>
                <input type="date" id="start_date" wire:model="start_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div class="w-full">
                <label for="start_time" class="block text-sm font-medium text-gray-700 w-full">Start Time</label>
                <input type="time" id="start_time" wire:model="start_time" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div class="w-full">
                <label for="end_date" class="block text-sm font-medium text-gray-700 w-full">Start Date</label>
                <input type="date" id="end_date" wire:model="end_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
            <div class="w-full">
                <label for="end_time" class="block text-sm font-medium text-gray-700 w-full">End Time</label>
                <input type="time" id="end_time" wire:model="end_time" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
            </div>
        </div>
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" wire:model="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
        </div>
        <div class="flex justify-end">
            <x-primary-button type="submit">
                Create Event
            </x-primary-button>
        </div>
    </form>
</div>
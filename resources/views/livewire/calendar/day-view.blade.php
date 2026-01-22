
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
        <div class="space-y-4">
            {{-- Event items go here --}}
            <div class="p-4 bg-gray-100 rounded-lg">
                <h4 class="font-semibold">Sample Event 1</h4>
                <p class="text-sm text-gray-600">10:00 AM - 11:00 AM</p>
                <p class="mt-2">Description for Sample Event 1.</p>
            </div>
            <div class="p-4 bg-gray-100 rounded-lg">
                <h4 class="font-semibold">Sample Event 2</h4>
                <p class="text-sm text-gray-600">2:00 PM - 3:00 PM</p>
                <p class="mt-2">Description for Sample Event 2.</p>
            </div>
        </div>
    </div>
</div>

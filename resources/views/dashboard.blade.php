<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="space-x-2 w-full flex justify-end">
                <x-primary-button class="btn btn-xs" onclick="location.href='{{ route('calendar') }}'">
                    {{ __('Calendar') }}
                </x-primary-button>
                <x-primary-button onclick="location.href='{{ route('calendar.event.create') }}'">
                    {{ __('New Event') }}
                </x-primary-button>
                <x-primary-button class="btn btn-xs" onclick="location.href='{{ route('calendar') }}'">
                    {{ __('Calendar') }}
                </x-primary-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You have $count events") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@props([
    'types' => [],
])
@php
    use App\Models\EventType;
    $types = EventType::where('family_id', auth()->user()->family_id)
        ->orWhereNull('family_id')
        ->get();
@endphp
<section>
    <header>
        <div class="w-full flex justify-between items-center">
            <div class="w-full">
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Event Types') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("Edit your event types.") }}
                </p>
            </div>
            <div class="w-full">
                <div class="flex justify-end">
                    <x-primary-button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-new-type')"
                    >{{ __('Create New Type') }}</x-primary-button>
                </div>
            </div>
        </div>
    </header>
    <div class="grid grid-cols-2 gap-4 mt-4">
        @foreach($types as $type)
            <div class='p-1 md:p-2 bg-[{{ $type->color }}] text-white shadow sm:rounded-lg text-center flex flex-row mx-auto w-full justify-center items-center'>
                {{ $type->name }} | {{ $type->color }} | <span class="text-xs items-center px-1 md:px-2">{{ $type->description }}</span> | <x-icons.edit-icon class="justify-end items-center" /><span class="w-auto cursor-pointer" wire:click="deleteType({{ $type->id }})"><x-icons.trash-icon class="items-center" /></span>
            </div>
        @endforeach
    </div>

    <x-modal name="create-new-type" :show="$errors->isNotEmpty()" focusable>
        <form wire:submit="createType" class="p-6">
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Create New Event Type') }}
            </p>

            <div class="mt-6">
                <x-input-label for="type-name" value="{{ __('Type Name') }}" class="sr-only" />
                <x-text-input
                    wire:model="typeName"
                    id="type-name"
                    name="type-name"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="{{ __('Type Name') }}"
                />
                <x-input-error :messages="$errors->get('type-name')" class="mt-2" />
            </div>

            {{-- Color Picker --}}
            <div class="mt-6">
                <x-input-label for="type-color" value="{{ __('Type Color') }}" class="" />
                <x-text-input
                    wire:model="typeColor"
                    id="type-color"
                    name="type-color"
                    type="color"
                    class="mt-1 block w-1/4"
                    placeholder="{{ __('Type Color') }}"
                />
                <x-input-error :messages="$errors->get('type-color')" class="mt-2" />
            </div>

            <div class="mt-6">
                <x-input-label for="type-description" value="{{ __('Type Description') }}" class="sr-only" />
                <textarea
                    wire:model="typeDescription"
                    id="type-description"
                    name="type-description"
                    type="text"
                    rows="3"
                    class="mt-1 block w-full rounded-lg border-gray-300"
                    placeholder="{{ __('Type Description') }}"
                ></textarea>
                <x-input-error :messages="$errors->get('type-description')" class="mt-2" />
            </div>
            
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Create Type') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</section>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Family Details') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your family's details.") }}
        </p>
    </header>

    <form wire:submit="updateFamilyDetails" class="mt-6 space-y-6">
        {{-- Family Name --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="family_name" id="family_name" name="family_name" type="text" class="mt-1 block w-full" required autofocus autocomplete="family_name" />
            <x-input-error class="mt-2" :messages="$errors->get('family_name')" />
        </div>

        {{-- Family Description --}}
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input wire:model="family_description" id="family_description" name="family_description" type="text" class="mt-1 block w-full" required autofocus autocomplete="family_description" />
            <x-input-error class="mt-2" :messages="$errors->get('family_description')" />
        </div>

        {{-- Save Button --}}
        <div class="flex justify-between w-full items-center">
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                <x-action-message class="me-3" on="family-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>

            <div class="flex items-center gap-4">
                <x-danger-button wire:confirm="This will delete the family and all the users that are part of it. Continue?" type="button" wire:click.prevent="confirmDelete">{{ __('Delete Family') }}</x-danger-button>
                <x-action-message class="me-3" on="family-deleted">
                    {{ __('Deleted.') }}
                </x-action-message>
            </div>
        </div>
    </form>
</section>
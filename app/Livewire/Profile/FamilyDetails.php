<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\Family;

class FamilyDetails extends Component
{
    public ?Family $family = null;
    /**
     * Stores the name of the family.
     *
     * @var string|null
     */
    public ?string $family_name = null;

    /**
     * Stores the family description.
     *
     * @var string|null
     */
    public ?string $family_description = null;

    /**
     * Runs when the component is displayed.
     *
     * @return void
     */
    public function render()
    {
        $this->family = auth()->user()->family;
        $this->family_name = $this->family?->name;
        $this->family_description = $this->family?->description;

        return view('livewire.profile.family-details');
    }

    /**
     * Update Family Details.
     *
     * @return void
     */
    public function updateFamilyDetails()
    {
        $this->validate([
            'family_name' => 'required|string|max:255',
            'family_description' => 'nullable|string|max:1000',
        ]);

        $this->family->update([
            'name' => $this->family_name,
            'description' => $this->family_description,
        ]);

        session()->flash('status', __('Family details updated successfully.'));
        $this->dispatch('family-updated', name: $this->family->name);
    }

    /**
     * Delete the family.
     *
     * @return void
     */
    public function confirmDelete()
    {
        dd('To Be Implemented');
    }
}

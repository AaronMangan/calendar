<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\EventType;

class EditTypes extends Component
{
    public ?string $typeName = null;
    public ?string $typeColor = null;
    public ?string $typeIcon = null;
    public ?string $typeDescription = null;
    public EventType $editType;
    
    public function editType(EventType $type)
    {
        $this->editType = $type;
        $this->typeName = $type->name;
        $this->typeColor = $type->color;
        $this->typeIcon = $type->icon;
        $this->typeDescription = $type->description;

        $this->dispatch('open-modal', 'edit-type-modal');
    }

    /**
     * Delete the Event Type
     *
     * @param integer $id
     * @return void
     */
    public function deleteType(int $id)
    {
        // Check if the user has permission first, then delete the event type.
        if (auth()->user()->hasPermissionTo('edit calendar')) {
            $this->editType = EventType::find($id);
            $this->editType->delete();
        }
    }

    /**
     * Creates a new type
     *
     * @return void
     */
    public function createType()
    {
        $this->validate([
            'typeName' => 'required|string|max:255',
            'typeColor' => 'nullable|string|max:7',
            'typeIcon' => 'nullable|string|max:255',
            'typeDescription' => 'nullable|string|max:1000',
        ]);

        $newType = EventType::create([
            'name' => $this->typeName ?? 'New Type',
            'color' => $this->typeColor ?? '#000000',
            'icon' => $this->typeIcon ?? null,
            'description' => $this->typeDescription ?? null,
            'family_id' => auth()->user()->family_id,
        ]);

        $this->reset('typeName');
        $this->dispatch('close-modal', 'create-new-type');
    }

    /**
     * Render the component,
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.profile.edit-types');
    }
}

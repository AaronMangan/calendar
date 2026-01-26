<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TYPES = [
        ['name' => 'Meeting', 'color' => '#1E90FF', 'description' => 'A scheduled meeting', 'icon' => 'user-group', 'family_id' => null],
        ['name' => 'Birthday', 'color' => '#FF69B4', 'description' => 'A person\'s birthday ',  'icon' => 'cake', 'family_id' => null],
        ['name' => 'Holiday', 'color' => '#32CD32', 'description' => 'A public holiday',  'icon' => 'flag', 'family_id' => null],
        ['name' => 'Anniversary', 'color' => '#FFD700', 'description' => 'An anniversary event',  'icon' => 'bell', 'family_id' => null],
        ['name' => 'Reminder', 'color' => '#FF4500', 'description' => 'A personal reminder',  'icon' => 'alarm', 'family_id' => null],
        ['name' => 'Appointment', 'color' => '#8A2BE2', 'description' => 'A scheduled appointment',  'icon' => 'building-office', 'family_id' => null],
        ['name' => 'Task', 'color' => '#20B2AA', 'description' => 'A task to be completed',  'icon' => 'bars-3', 'family_id' => null],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add the types for the types table.
        collect(self::TYPES)->each(function ($type) {
            \App\Models\EventType::create($type);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $types = App\Models\EventType::all();
        $types->each(function ($type) {
            $type->delete();
        });
    }
};

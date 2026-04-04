<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TYPES = [
        ['name' => 'Meeting', 'color' => '#1E90FF', 'description' => 'A scheduled meeting', 'icon' => 'user-group', 'family_id' => null, 'key' => 'meeting', 'text_color' => 'white'],
        ['name' => 'Birthday', 'color' => '#FF69B4', 'description' => 'A person\'s birthday ',  'icon' => 'cake', 'family_id' => null, 'key' => 'birthday', 'text_color' => ''],
        ['name' => 'Holiday', 'color' => '#32CD32', 'description' => 'A public holiday',  'icon' => 'flag', 'family_id' => null, 'key' => 'holiday', 'text_color' => 'white'],
        ['name' => 'Anniversary', 'color' => '#FFD700', 'description' => 'An anniversary event',  'icon' => 'bell', 'family_id' => null, 'key' => 'anniversary', 'text_color' => ''],
        ['name' => 'Reminder', 'color' => '#FF4500', 'description' => 'A personal reminder',  'icon' => 'alarm', 'family_id' => null, 'key' => 'reminder', 'text_color' => 'white'],
        ['name' => 'Appointment', 'color' => '#8A2BE2', 'description' => 'A scheduled appointment',  'icon' => 'building-office', 'family_id' => null, 'key' => 'appointment', 'text_color' => 'white'],
        ['name' => 'Task', 'color' => '#20B2AA', 'description' => 'A task to be completed',  'icon' => 'bars-3', 'family_id' => null, 'key' => 'task', 'text_color' => ''],
        ['name' => 'Other', 'color' => '#494949', 'description' => 'For events not related to any other category',  'icon' => 'flag', 'family_id' => null, 'key' => 'other', 'text_color' => 'white'],
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

        Schema::table('calendar_events', function (Blueprint $table) {
            $table->foreignId('event_type_id')->nullable()->constrained('event_types')->onDelete('set null');
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

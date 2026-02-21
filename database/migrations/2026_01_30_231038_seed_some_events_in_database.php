<?php

use App\Models\User;
use App\Models\Family;
use Illuminate\Support\Str;
use App\Models\CalendarEvent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    
        if (! User::where('email', 'azza.mangan@gmail.com')->exists()) {
            $user = User::create([
                'name' => 'Aaron Mangan',
                'email' => 'azza.mangan@gmail.com',
                'password' => bcrypt('azza.mangan@gmail.com'),
            ]);
            $randomCode = Str::random(25);
            
            while (Family::where('code', $randomCode)->exists()) {
                $randomCode = Str::random(25);
            }

            $family = Family::create([
                'name' =>'Jaspers House',
                'description' => 'A House for Jaspers Family',
                'status' => 'active',
                'code' => Str::random(25),
                'created_by' => User::first()->id,
                'timezone' => 'Australia/Brisbane',
            ]);

            // Assign the family to the user
            $user->family_id = $family->id;
            $user->assignRole('superadmin');
            $user->save();

            $user_id = $user->id;
            $family_id = $user->family->id;
        }

        $events = [
            [
                'title' =>'Morning Meeting',
                'description' => 'The morning catch up with the team',
                'from' => now()->subHour(),
                'to' => now(),
                'location' => 'Meeting Room 1',
                'all_day' => 0,
                'is_public' => 0,
                'status' => 'active',
                'user_id' => $user_id,
                'family_id' => $family_id,
                'event_type_id' => 1,
            ],
            [
                'title' =>'Jasper Vet Appointment',
                'description' => 'An appointment at the vet for Jasper',
                'from' => now()->addDay(),
                'to' => now()->addDay()->addHour(),
                'location' => 'The Vet',
                'all_day' => 0,
                'is_public' => 0,
                'status' => 'active',
                'user_id' => $user_id,
                'family_id' => $family_id,
                'event_type_id' => 6,
            ],
            [
                'title' =>'Training',
                'description' => 'Training for the thing',
                'from' => now()->addDays(2)->startOfDay(),
                'to' => now()->addDays(2)->endOfDay(),
                'location' => 'Training Facility',
                'all_day' => 1,
                'is_public' => 0,
                'status' => 'active',
                'user_id' => $user_id,
                'family_id' => $family_id,
                'event_type_id' => 7,
            ],
            [
                'title' =>'Multiple Day Event',
                'description' => 'to see how multiple events are handled',
                'from' => now()->startOfDay(),
                'to' => now()->addDays(2)->endOfDay(),
                'location' => 'Somewhere, in the galaxy',
                'all_day' => 1,
                'is_public' => 0,
                'status' => 'active',
                'user_id' => $user_id,
                'family_id' => $family_id,
                'event_type_id' => 4,
            ],
        ];

        Schema::table('calendar_events', function (Blueprint $table) use ($events) {
            collect($events)->each(function ($event) {
                CalendarEvent::create($event);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_events');
    }
};

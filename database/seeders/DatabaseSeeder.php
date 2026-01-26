<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Family;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
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
            'name' => 'Jaspers House',
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
    }
}

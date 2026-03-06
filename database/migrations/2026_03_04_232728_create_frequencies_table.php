<?php

use App\Models\Frequency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const FREQUENCIES = [
        ['name' => 'Daily', 'description' => 'Occurs every day', 'is_active' => true, 'is_default' => false],
        ['name' => 'Weekly', 'description' => 'Occurs every week', 'is_active' => true, 'is_default' => true],
        ['name' => 'Fortnightly', 'description' => 'Occurs every two weeks', 'is_active' => true, 'is_default' => false],
        ['name' => 'Tri-weekly', 'description' => 'Occurs every three weeks', 'is_active' => true, 'is_default' => false],
        ['name' => 'Monthly', 'description' => 'Occurs every month', 'is_active' => true, 'is_default' => false],
        ['name' => 'Bi-monthly', 'description' => 'Occurs every two months', 'is_active' => true, 'is_default' => false],
        ['name' => 'Quarterly', 'description' => 'Occurs every quarter', 'is_active' => true, 'is_default' => false],
        ['name' => 'Yearly', 'description' => 'Occurs every year', 'is_active' => true, 'is_default' => false],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('frequencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });

        Schema::table('frequencies', function (Blueprint $table) {
            collect(self::FREQUENCIES)->each(function ($freq) {
                Frequency::create($freq);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frequencies');
    }
};

<?php

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
        Schema::create('calendar_events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->dateTime('from');
            $table->dateTime('to')->nullable();
            $table->text('location')->nullable();
            $table->boolean('all_day')->default(false);
            $table->boolean('is_public')->default(true);
            $table->string('status')->default('active');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('family_id')->constrained('families')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

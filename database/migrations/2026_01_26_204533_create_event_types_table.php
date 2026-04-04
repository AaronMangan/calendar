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
        Schema::create('event_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->foreignId('family_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('key', 200);
            $table->string('text_color', 100)->default('black');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_types', function (Blueprint $table) {
            $table->dropForeign(['family_id']);
        });

        Schema::dropIfExists('event_types');
    }
};

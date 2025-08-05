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
        Schema::create('contact_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Boston, California, Portland
            $table->string('slug')->unique();
            $table->text('address');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('map_iframe_url')->nullable();
            $table->string('weekday_hours')->nullable(); // Mon-Fri hours
            $table->string('weekend_hours')->nullable(); // Sat-Sun hours
            $table->string('background_image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false); // First tab
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_locations');
    }
};

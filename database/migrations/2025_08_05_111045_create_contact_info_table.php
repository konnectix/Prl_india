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
        Schema::create('contact_info', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // e.g., 'support_phone', 'headquarters_address'
            $table->string('label'); // Display label
            $table->text('value'); // The actual content
            $table->string('type')->default('text'); // text, email, phone, address, textarea
            $table->string('icon')->nullable(); // FontAwesome icon class
            $table->string('section')->default('general'); // general, header, footer
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_info');
    }
};

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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->enum('video_type', ['upload', 'youtube', 'vimeo', 'external'])->default('upload');
            $table->string('video_url')->nullable(); // For YouTube/Vimeo/External URLs
            $table->string('video_file')->nullable(); // For uploaded videos
            $table->string('thumbnail')->nullable(); // Video thumbnail/poster image
            $table->string('youtube_id')->nullable(); // Extracted YouTube video ID
            $table->integer('duration')->nullable(); // Video duration in seconds
            $table->text('alt_text')->nullable();
            $table->json('tags')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('views_count')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('video_categories')->onDelete('cascade');
            $table->index(['category_id', 'is_active']);
            $table->index(['is_featured', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};

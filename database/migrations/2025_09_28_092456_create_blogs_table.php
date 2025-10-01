<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            $table->longText('excerpt');
            $table->longText('description');

            $table->string('thumbnail');
            $table->string('featured_image');

            $table->string('meta_title');
            $table->text('meta_description');

            $table->timestamp('published_at');

            $table->string('status')->index();          // e.g., draft, scheduled, published
            $table->boolean('is_featured')->default(false)->index();

            $table->unsignedBigInteger('view_count')->default(0);
            $table->unsignedSmallInteger('reading_time'); // minutes

            $table->string('video_url')->nullable();
            $table->string('location')->nullable();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();

            $table->index(['created_by', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

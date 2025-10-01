<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->boolean('is_active')->default(true)->index();
            $table->string('title');
            $table->string('slug')->unique();

            $table->longText('description');
            $table->string('thumbnail'); // store image path

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('canonical_url');
            $table->string('meta_title');
            $table->text('meta_description');

            $table->timestamps();

            $table->index(['created_by']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

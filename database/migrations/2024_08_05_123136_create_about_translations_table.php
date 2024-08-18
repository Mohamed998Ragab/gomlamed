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
        Schema::create('about_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_id')->constrained('abouts')->cascadeOnDelete();
            $table->foreignId('language_id')->constrained('languages')->cascadeOnDelete();

            $table->string('first_title');
            $table->longText('first_description');
            $table->string('second_title');
            $table->longText('second_description');
            $table->string('third_title');
            $table->longText('third_description');
            $table->timestamps();

            $table->unique(['about_id', 'language_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_translations');
    }
};

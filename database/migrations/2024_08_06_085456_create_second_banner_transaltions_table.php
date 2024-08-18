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
        Schema::create('second_banner_transaltions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('second_banner_id')->constrained('second_banners')->cascadeOnDelete();
            $table->foreignId('language_id')->constrained('languages')->cascadeOnDelete();
            $table->string('title');
            $table->string('description');

            $table->timestamps();

            $table->unique(['second_banner_id', 'language_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('second_banner_transaltions');
    }
};

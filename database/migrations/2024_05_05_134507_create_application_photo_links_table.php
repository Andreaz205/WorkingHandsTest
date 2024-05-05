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
        Schema::create('application_photo_links', function (Blueprint $table) {
            $table->id();

            $table->string('link');

            $table->boolean('is_main')
                ->default(false);

            $table->foreignId('application_id')
                ->constrained('applications')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_photo_links');
    }
};

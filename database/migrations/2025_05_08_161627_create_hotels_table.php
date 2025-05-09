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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Hotel Name
            $table->string('location'); // Location of the hotel
            $table->text('amenities'); // List of amenities (can be stored as JSON or a simple text list)
            $table->decimal('price', 8, 2); // Price per night
            $table->boolean('availability')->default(true); // Availability status (true/false)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};

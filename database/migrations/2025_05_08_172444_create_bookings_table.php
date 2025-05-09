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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who booked
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade'); // Associated hotel
            $table->foreignId('car_id')->constrained()->onDelete('cascade'); // Associated car
            $table->date('start_date'); // Start date of the booking
            $table->date('end_date'); // End date of the booking
            $table->decimal('total_price', 8, 2); // Total cost of the booking (including hotel and car)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->string('type'); // flight, train, bus
        $table->string('from_location');
        $table->string('to_location');
        $table->date('departure_date');
        $table->time('departure_time');
        $table->decimal('price', 10, 2);
        $table->timestamps();
        });
    }

    // public function up(): void
    // {
    //     Schema::create('tickets', function (Blueprint $table) {
    //         $table->id();
    //         $table->timestamps();
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

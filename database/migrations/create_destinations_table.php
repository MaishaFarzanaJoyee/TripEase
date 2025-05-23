<?php

     use Illuminate\Database\Migrations\Migration;
     use Illuminate\Database\Schema\Blueprint;
     use Illuminate\Support\Facades\Schema;

     return new class extends Migration
     {
         public function up(): void
         {
             Schema::create('destinations', function (Blueprint $table) {
                 $table->id();
                 $table->string('name');
                 $table->string('location');
                 $table->decimal('average_rating', 3, 2)->default(0);
                 $table->timestamps();
             });
         }

         public function down(): void
         {
             Schema::dropIfExists('destinations');
         }
     };
<?php

     use Illuminate\Database\Migrations\Migration;
     use Illuminate\Database\Schema\Blueprint;
     use Illuminate\Support\Facades\Schema;

     return new class extends Migration
     {
         public function up(): void
         {
             Schema::create('activities', function (Blueprint $table) {
                 $table->id();
                 $table->string('name');
                 $table->foreignId('destination_id')->constrained()->onDelete('cascade');
                 $table->decimal('price', 8, 2);
                 $table->decimal('average_rating', 3, 2)->default(0);
                 $table->timestamps();
             });
         }

         public function down(): void
         {
             Schema::dropIfExists('activities');
         }
     };
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
        // Add the is_admin column to the users table
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false); // Default to false for regular users
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the is_admin column in case of rollback
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
};

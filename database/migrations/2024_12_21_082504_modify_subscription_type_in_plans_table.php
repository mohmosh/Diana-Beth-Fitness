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
        Schema::table('plans', function (Blueprint $table) {
            // Modify subscription_type to unsignedBigInteger
            $table->unsignedBigInteger('subscription_type')->nullable()->change();  // Change to the correct type
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            // Optionally, revert the change if needed
            $table->string('subscription_type')->nullable()->change();
        });
    }
};

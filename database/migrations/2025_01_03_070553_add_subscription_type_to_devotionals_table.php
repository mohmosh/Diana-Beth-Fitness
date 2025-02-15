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
        Schema::table('devotionals', function (Blueprint $table) {
            $table->string('subscription_type')->nullable(); // Add the column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devotionals', function (Blueprint $table) {
            $table->dropColumn('subscription_type'); // Drop the column
        });
    }
};

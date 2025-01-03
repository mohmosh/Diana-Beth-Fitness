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
            $table->dropForeign(['plan_id']); // Drop the foreign key constraint
            $table->dropColumn('plan_id'); // Remove the column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devotionals', function (Blueprint $table) {
            $table->foreignId('plan_id')->constrained()->onDelete('cascade'); // Re-add the column
        });
    }
};

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
        Schema::table('subscriptions', function (Blueprint $table) {
            // Add the subscription_type column
            $table->unsignedBigInteger('subscription_type')->nullable();

            // Add foreign key constraint
            $table->foreign('subscription_type')
                  ->references('id')
                  ->on('plans')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Drop foreign key and column if needed
            $table->dropForeign(['subscription_type']);
            $table->dropColumn('subscription_type');
        });
    }
};


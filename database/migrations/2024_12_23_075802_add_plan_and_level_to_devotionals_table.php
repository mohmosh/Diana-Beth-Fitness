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

            // Add level_required to specify the required level to access the devotional
            $table->unsignedInteger('level_required')->default(1)->after('plan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devotionals', function (Blueprint $table) {
            // Drop the columns if rolling back the migration
            $table->dropColumn('level_required');
        });
    }
};


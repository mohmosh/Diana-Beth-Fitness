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
            // Modify column 'column_name' to a new data type
            $table->unsignedInteger('current_level')->default(null)->nullable()->change();
            $table->boolean('level_approval')->default(null)->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

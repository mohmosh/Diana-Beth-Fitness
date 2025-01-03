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
        Schema::table('devotionals', function (Blueprint $table) {
            $table->string('document_path')->nullable(); // Add document_path column
        });
    }

    public function down()
    {
        Schema::table('devotionals', function (Blueprint $table) {
            $table->dropColumn('document_path'); // Remove document_path column if rollback is needed
        });
    }
};

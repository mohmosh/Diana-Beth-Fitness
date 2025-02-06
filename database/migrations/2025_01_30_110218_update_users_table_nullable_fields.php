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
        Schema::table('users', function (Blueprint $table) {
            $table->string('level_jump_requested')->nullable()->change();
            $table->string('level')->nullable()->change();
            $table->string('on_trial')->nullable()->change();

        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('level_jump_requested')->nullable()->change();
            $table->string('level')->nullable()->change();
            $table->string('on_trial')->nullable()->change();

        });
    }
};

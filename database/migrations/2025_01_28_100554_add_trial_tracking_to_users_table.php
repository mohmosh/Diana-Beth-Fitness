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

            $table->boolean('on_trial')->default(false);
            $table->timestamp('trial_start_date')->nullable();
            $table->timestamp('trial_end_date')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->dropColumn(['on_trial', 'trial_start_date', 'trial_end_date']);
        });
    }
};

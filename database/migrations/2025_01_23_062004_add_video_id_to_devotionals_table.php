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


            $table->foreignId('video_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('devotionals', function (Blueprint $table) {
            
            $table->dropForeign(['video_id']);
        });
    }

};

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
        if (!Schema::hasColumn('devotionals', 'video_id')) { 
            Schema::table('devotionals', function (Blueprint $table) {
                $table->bigInteger('video_id')->unsigned()->notNull();
            });
        }
    }

    public function down()
    {
        Schema::table('devotionals', function (Blueprint $table) {

            $table->dropForeign(['video_id']);
        });
    }

};

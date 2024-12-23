<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlanIdToDevotionalsTable extends Migration
{
    public function up()
    {
        Schema::table('devotionals', function (Blueprint $table) {
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('devotionals', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
            $table->dropColumn('plan_id');
        });
    }
}

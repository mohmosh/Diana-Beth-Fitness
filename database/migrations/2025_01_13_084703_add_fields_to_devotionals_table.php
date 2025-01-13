<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('devotionals', function (Blueprint $table) {
            $table->longText('document_content')->nullable();
        });
    }

    public function down() {
        Schema::table('devotionals', function (Blueprint $table) {
            $table->dropColumn(['subscription_type', 'level_required', 'document_content']);
        });
    }
};

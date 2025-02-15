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
        Schema::create('devotionals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');

            $table->foreignId('plan_id')->constrained()->onDelete('cascade');

            $table->unsignedBigInteger('uploaded_by');
            $table->timestamps();
        });
        




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devotionals');
    }
};

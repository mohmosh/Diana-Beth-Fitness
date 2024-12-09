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
        Schema::create('user_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Title of the user  content
            $table->text('description'); // Content description
            $table->string('media_path')->nullable(); // Path for associated media
            $table->unsignedBigInteger('user_id'); // User who submitted this content
            $table->string('status')->default('pending'); // Status: 'pending', 'approved', or 'rejected'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_contents');
    }
};

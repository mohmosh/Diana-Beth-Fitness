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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('fitness_goal')->nullable();
            $table->string('preferences')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('subscription_type')->nullable(); // 'personal_training' or 'build_his_temple'
            $table->unsignedInteger('current_level')->default(1); // Default level for 'Build His Temple'
            $table->boolean('level_approval')->default(false); // Admin approval for level jumps
            $table->string('role_id');


            // $table->unsignedBigInteger('role_id')->default(2); // Set default to 2 for regular users
            // $table->foreign('role_id')->references('id')->on('roles')->nulla

            // $table->foreignId('role_id')->constrained('roles');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // User who made the payment
            $table->unsignedBigInteger('subscription_id'); // Subscription plan ID
            $table->decimal('amount', 10, 2); // Payment amount
            $table->string('currency', 10)->default('USD'); // Currency used
            $table->string('payment_method')->nullable(); // Payment method (e.g., card, PayPal)
            $table->string('transaction_id')->nullable(); // Payment gateway transaction ID
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending'); // Payment status
            $table->timestamp('paid_at')->nullable(); // When payment was made
            $table->timestamps(); // Created_at and updated_at

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}


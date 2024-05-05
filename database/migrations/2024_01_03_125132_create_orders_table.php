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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('table_id');
            $table->string('restaurant_name')->nullable();
            $table->string('order_status')->default('pending'); // Adds an order_status field with a default value
            $table->decimal('total_price', 8, 2); // Adds a total_price field to store the total price of the order
            $table->decimal('paid_amount', 8, 2)->default(0.00); // Tracks the amount paid towards the total price
            $table->string('payment_status')->default('unpaid'); // Tracks payment status - options could be 'unpaid', 'partial', 'paid'
            $table->timestamps();

            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

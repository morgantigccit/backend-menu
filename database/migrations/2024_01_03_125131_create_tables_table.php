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
        Schema::create('tables', function (Blueprint $table) {
            $table->id(); // Change to id() without any argument
            $table->integer('TableNumber');
            $table->string('qrcode')->nullable();
            $table->enum('Status', ['Available', 'Occupied'])->default('Available');
            $table->timestamps();
            $table->string('restaurant_name');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};

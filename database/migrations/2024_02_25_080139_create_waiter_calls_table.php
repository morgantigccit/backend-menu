<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaiterCallsTable extends Migration
{
    public function up()
    {
        Schema::create('waiter_calls', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_name')->nullable();
            $table->integer('table_number');
            $table->timestamps(); // Optional: to track when the call was made
        });
    }

    public function down()
    {
        Schema::dropIfExists('waiter_calls');
    }
}

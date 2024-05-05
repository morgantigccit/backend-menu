<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnToWaiterCallsTable extends Migration
{
    public function up()
    {
        Schema::table('waiter_calls', function (Blueprint $table) {
            // Add the new column 'type' as nullable
            $table->string('type')->nullable()->after('restaurant_name');
        });
    }

    public function down()
    {
        Schema::table('waiter_calls', function (Blueprint $table) {
            // Drop the 'type' column if the migration is rolled back
            $table->dropColumn('type');
        });
    }
}

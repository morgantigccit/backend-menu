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
        DB::statement('ALTER TABLE order_items CHANGE menu_item_id MenuItemID BIGINT UNSIGNED NOT NULL');
    }
    
    public function down()
    {
        DB::statement('ALTER TABLE order_items CHANGE MenuItemID menu_item_id BIGINT UNSIGNED NOT NULL');
    }
    
    
};

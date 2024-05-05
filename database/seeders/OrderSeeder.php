<?php

namespace Database\Seeders;

// database/seeders/OrderSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Insert sample data into the 'orders' table
        DB::table('orders')->insert([
            ['TableID' => 1, 'status' => 'pending'],
            // Add more sample data as needed
        ]);

        // Insert sample data into the 'order_items' table
        DB::table('order_items')->insert([
            ['OrderID' => 1, 'MenuItemID' => 1, 'quantity' => 2],
            // Add more sample data as needed
        ]);
    }
}

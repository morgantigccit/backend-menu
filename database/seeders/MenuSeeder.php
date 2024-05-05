<?php

namespace Database\Seeders;

// database/seeders/MenuSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Insert sample data into the 'menu' table
        DB::table('menu')->insert([
            ['MenuItemID' => 1, 'Name' => 'Dish 1', 'Description' => 'Description 1', 'Price' => 10.99, 'Category' => 'Appetizer', 'Image' => 'dish1.jpg'],
            ['MenuItemID' => 2, 'Name' => 'Dish 2', 'Description' => 'Description 2', 'Price' => 15.99, 'Category' => 'Main Course', 'Image' => 'dish2.jpg'],
            // Add more sample data as needed
        ]);
    }
}

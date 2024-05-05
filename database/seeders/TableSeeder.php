<?php

namespace Database\Seeders;

// database/seeders/TableSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableSeeder extends Seeder
{
    public function run()
    {
        // Insert sample data into the 'tables' table
        DB::table('tables')->insert([
            ['table_number' => 1, 'status' => 'available'],
            ['table_number' => 2, 'status' => 'available'],
            // Add more sample data as needed
        ]);
    }
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            ['table_number' => 1, 'capacity' => 2],
            ['table_number' => 2, 'capacity' => 2],
            ['table_number' => 3, 'capacity' => 3],
            ['table_number' => 4, 'capacity' => 3],
            ['table_number' => 5, 'capacity' => 4],
            ['table_number' => 6, 'capacity' => 4],
            ['table_number' => 7, 'capacity' => 4],
            ['table_number' => 8, 'capacity' => 6],
            ['table_number' => 9, 'capacity' => 6],
            ['table_number' => 10, 'capacity' => 8],
        ];

        foreach ($tables as $table) {
            DB::table('restaurant_tables')->insert([
                'table_number' => $table['table_number'],
                'capacity' => $table['capacity'],
                'status' => 'free',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

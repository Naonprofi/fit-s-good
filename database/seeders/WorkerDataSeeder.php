<?php

namespace Database\Seeders;

use App\Models\WorkerData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkerDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkerData::factory(10)->create();
    }
}

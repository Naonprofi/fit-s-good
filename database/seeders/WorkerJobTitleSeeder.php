<?php

namespace Database\Seeders;

use App\Models\WorkerJobTitle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkerJobTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkerJobTitle::factory(10)->create();
    }
}

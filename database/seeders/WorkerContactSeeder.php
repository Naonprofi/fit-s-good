<?php

namespace Database\Seeders;

use App\Models\WorkerContact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkerContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkerContact::factory(10)->create();
    }
}

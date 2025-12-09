<?php

namespace Database\Seeders;

use App\Models\WorkerSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkerScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkerSchedule::factory(10)->create();
    }
}

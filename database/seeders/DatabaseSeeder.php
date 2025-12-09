<?php

namespace Database\Seeders;

use App\Http\Controllers\CustMembershipController;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CustContactSeeder::class,
            CustDataSeeder::class,
            CustMembershipController::class,
            CustomerSeeder::class,
            ReservationSeeder::class,
            UserSeeder::class,
            WorkerContactSeeder::class,
            WorkerDataSeeder::class,
            WorkerJobTitleSeeder::class,
            WorkerScheduleSeeder::class,
            WorkerSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\CustContact;
use App\Models\CustData;
use App\Models\CustMembership;
use App\Models\Customer;
use App\Models\User;
use App\Models\Worker;
use App\Models\WorkerContact;
use App\Models\WorkerData;
use App\Models\WorkerJobTitle;
use App\Models\WorkerSchedule;
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
        CategorySeeder::class,
        AdminSeeder::class,
    ]);
            // --- 1. VÉLETLENSZERŰ CUSTOMEREK (10 db) ---
    for ($i = 0; $i < 10; $i++) {
        Customer::factory()
            ->for(CustData::factory(), 'custData')
            ->for(CustContact::factory(), 'custContact')
            ->for(CustMembership::factory(), 'custMembership')
            ->for(User::factory(), 'user')
            ->create();
    }

    // --- 2. VÉLETLENSZERŰ WORKEREK (10 db) ---
    for ($i = 0; $i < 10; $i++) {
        Worker::factory()
            ->for(WorkerData::factory(), 'workerData')
            ->for(WorkerContact::factory(), 'workerContact')
            ->for(WorkerJobTitle::factory(), 'workerJobTitle')
            ->for(WorkerSchedule::factory(), 'workerSchedule')
            ->create();
    }

    // --- 3. A TE SAJÁT FIX CUSTOMERED ---
    Customer::factory()
        ->for(CustData::factory()->state([
            'cust_name' => 'Tamás Vittay',
            'cust_gender' => 'male',
            'cust_age' => 19,
        ]), 'custData')
        ->for(CustContact::factory()->state([
            'cust_email' => 'mv.tamas.attila@gmail.com',
            'cust_phone_num' => '+36306033792',
        ]), 'custContact')
        ->for(CustMembership::factory()->state([
            'type' => 'premium',
        ]), 'custMembership')
        ->for(User::factory()->state([
            'name' => 'Tamás Vittay', 
            'email' => 'mv.tamas.attila@gmail.com'
        ]), 'user')
        ->create();
    }
}

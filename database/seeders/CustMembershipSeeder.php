<?php

namespace Database\Seeders;

use App\Models\CustMembership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustMembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustMembership::factory(10)->create();
    }
}

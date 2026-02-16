<?php

namespace Database\Seeders;

use App\Models\CustContact;
use App\Models\CustData;
use App\Models\CustMembership;
use App\Models\Customer;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // 1. Személyes adatok az adminnak
            $data = CustData::create([
                'cust_name' => 'Admin',
                'cust_age' => 19,
                'cust_gender' => 'male',
            ]);

            // 2. Elérhetőség
            $contact = CustContact::create([
                'cust_email' => 'admin@gmail.com',
                'cust_phone_num' => '+36000000000',
            ]);

            // 3. Tagság (neki is adjunk egy saját 'none' sort, hogy konzisztens legyen)
            $membership = CustMembership::create([
                'type' => 'none',
            ]);

            // 4. A konkrét User rekord az is_admin flag-gel
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'is_admin' => true, // Ez a fontos plusz!
            ]);

            // 5. Az összeszövés a Customer táblában
            Customer::create([
                'user_id' => $user->id,
                'cust_data_id' => $data->id,
                'cust_contact_id' => $contact->id,
                'membership_id' => $membership->id,
            ]);
        });
    }
}

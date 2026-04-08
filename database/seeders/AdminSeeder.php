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

            $data = CustData::create([
                'cust_name' => 'Admin',
                'cust_age' => 19,
                'cust_gender' => 'male',
            ]);

            $contact = CustContact::create([
                'cust_email' => 'admin@gmail.com',
                'cust_phone_num' => '+36000000000',
            ]);

            $membership = CustMembership::create([
                'type' => 'none',
            ]);

            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]);

            Customer::create([
                'user_id' => $user->id,
                'cust_data_id' => $data->id,
                'cust_contact_id' => $contact->id,
                'membership_id' => $membership->id,
            ]);
        });
    }
}

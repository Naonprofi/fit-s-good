<?php

namespace Database\Factories;

use App\Models\CustContact;
use App\Models\CustData;
use App\Models\CustMembership;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cust_data_id'     => CustData::factory(),
            'cust_contact_id'  => CustContact::factory(),
            'membership_id'   => CustMembership::factory(),
            'user_id' => User::factory()
        ];
    }
}

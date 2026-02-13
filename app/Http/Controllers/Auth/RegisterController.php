<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CustContact;
use App\Models\CustData;
use App\Models\CustMembership;
use App\Models\Customer;
use App\Models\User;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'age' => ['required', 'integer', 'min:1', 'max:120'],
            'phone' => ['required', 'string', 'min:9', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]); 
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            
            // 1. Létrehozzuk a Data rekordot
            $custData = CustData::create([
                'cust_name'   => $data['name'],
                'cust_age'    => $data['age'],
                'cust_gender' => $data['gender'],
            ]);

            // 2. Létrehozzuk a Contact rekordot
            $custContact = CustContact::create([
                'cust_email' => $data['email'],
                'cust_phone_num' => $data['phone'],
            ]);

            // 3. Megkeressük vagy létrehozzuk az alapértelmezett tagságot
            // Ha már van "none" nevű tagságod az adatbázisban, az első sort használd
            $membership = CustMembership::Create(['type' => 'none']);

            // 4. Létrehozzuk a User-t
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            // 5. Összekötünk mindent a Customer táblában
            Customer::create([
                'user_id'         => $user->id,
                'cust_data_id'    => $custData->id,
                'cust_contact_id' => $custContact->id,
                'membership_id'   => $membership->id, // Itt az új kapcsolat
            ]);

            return $user;
        });
    }
}

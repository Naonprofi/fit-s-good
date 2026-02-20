<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\CustContact;
use App\Models\CustData;
use App\Models\CustMembership;
use App\Models\Customer;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Customer::class);

        if (Customer::count() === 0) {
            return response()->json(['msg' => 'There are no customers in the database'], 404);
        }

        return response()->json(Customer::with(['user', 'custData', 'custContact', 'custMembership'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $this->authorize('create', Customer::class);

        return DB::transaction(function () use ($request) {
            $validated = $request->validated();
            // 1. Személyes adatok (CustData)
            $custData = CustData::create([
                'cust_name' => $validated['name'],
                'cust_age' => $validated['age'],
                'cust_gender' => $validated['gender'],
            ]);

            // 2. Elérhetőség (CustContact)
            $custContact = CustContact::create([
                'cust_email' => $validated['email'],
                'cust_phone_num' => $validated['phone'],
            ]);

            // 3. Tagság (Membership) - Alapértelmezetten 'none'
            $membership = CustMembership::create([
                'type' => $validated['membership_type'] ?? 'none',
            ]);

            // 4. User rekord (hogy be tudjon lépni a weben is)
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // 5. A Customer tábla összekötése
            $customer = Customer::create([
                'user_id' => $user->id,
                'cust_data_id' => $custData->id,
                'cust_contact_id' => $custContact->id,
                'membership_id' => $membership->id,
            ]);

            return response()->json(['msg' => "{$customer->custData->cust_name} created successfully"], 201);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);

        // Ha nem létezik az ID, akkor lefut a te egyedi hibaüzeneted
        if (! $customer) {
            return response()->json([
                'msg' => "Customer with ID: {$id} not found",
            ], 404);
        }

        $this->authorize('view', $customer);

        return response()->json($customer->load(['user', 'custData', 'custContact', 'custMembership']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id): JsonResponse
    {
        $customer = Customer::find($id);

        if (! $customer) {
            return response()->json(['msg' => "Customer with ID: {$id} not found"], 404);
        }

        return DB::transaction(function () use ($request, $customer) {
            $v = $request->validated();

            // 1. Személyes adatok (Modell: custData)
            $customer->custData->update([
                'cust_name' => $v['name'] ?? $customer->custData->cust_name,
                'cust_age' => $v['age'] ?? $customer->custData->cust_age,
                'cust_gender' => $v['gender'] ?? $customer->cust_data->cust_gender,
            ]);

            // 2. Elérhetőség (Modell: custContact)
            $customer->custContact->update([
                'cust_email' => $v['email'] ?? $customer->custContact->cust_email,
                'cust_phone_num' => $v['phone'] ?? $customer->custContact->cust_phone_num,
            ]);

            // 3. Felhasználó
            $customer->user->update([
                'name' => $v['name'] ?? $customer->user->name,
                'email' => $v['email'] ?? $customer->user->email,
            ]);

            return response()->json([
                'msg' => 'Updated!',
                // Itt is CamelCase a load!
                'data' => $customer->load(['user', 'custData', 'custContact', 'custMembership']),
            ]);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        // 1. Megkeressük a rekordot kézzel
        $customer = Customer::find($id);

        // 2. Ha nem létezik, dobunk egy normális hibaüzenetet a "null" hiba helyett
        if (! $customer) {
            return response()->json(['msg' => "Customer with ID: {$id} not found"], 404);
        }

        // 3. Tranzakcióban törlünk mindent, hogy ne maradjon szemét az adatbázisban
        return DB::transaction(function () use ($customer) {
            // Fontos a sorrend: előbb a kapcsolódó táblák (CamelCase!), aztán a Customer

            // Töröljük a felhasználói fiókot
            if ($customer->user) {
                $customer->user->delete();
            }

            // Töröljük a személyes adatokat
            if ($customer->custData) {
                $customer->custData->delete();
            }

            // Töröljük a kontaktot
            if ($customer->custContact) {
                $customer->custContact->delete();
            }

            // Végül töröljük magát a Customer rekordot
            $customer->delete();

            return response()->json(['msg' => "{$customer->custData->cust_name} deleted successfully!"]);
        });
    }
}

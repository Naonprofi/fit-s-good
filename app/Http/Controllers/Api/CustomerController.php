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
            $custData = CustData::create([
                'cust_name' => $validated['name'],
                'cust_age' => $validated['age'],
                'cust_gender' => $validated['gender'],
            ]);

            $custContact = CustContact::create([
                'cust_email' => $validated['email'],
                'cust_phone_num' => $validated['phone'],
            ]);

            $membership = CustMembership::create([
                'type' => $validated['membership_type'] ?? 'none',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

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

            $customer->custData->update([
                'cust_name' => $v['name'] ?? $customer->custData->cust_name,
                'cust_age' => $v['age'] ?? $customer->custData->cust_age,
                'cust_gender' => $v['gender'] ?? $customer->custData->cust_gender,
            ]);

            $customer->custContact->update([
                'cust_email' => $v['email'] ?? $customer->custContact->cust_email,
                'cust_phone_num' => $v['phone'] ?? $customer->custContact->cust_phone_num,
            ]);

            $customer->user->update([
                'name' => $v['name'] ?? $customer->user->name,
                'email' => $v['email'] ?? $customer->user->email,
            ]);

            $customer->custMembership->update([
                'type' => $v['mem_type'] ?? $customer->custMembership->type,
            ]);

            return response()->json([
                'msg' => 'Updated!',
                'data' => $customer->load(['user', 'custData', 'custContact', 'custMembership']),
            ]);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $customer = Customer::find($id);

        if (! $customer) {
            return response()->json(['msg' => "Customer with ID: {$id} not found"], 404);
        }

        return DB::transaction(function () use ($customer) {

            if ($customer->user) {
                $customer->user->delete();
            }

            if ($customer->custData) {
                $customer->custData->delete();
            }

            if ($customer->custContact) {
                $customer->custContact->delete();
            }

            if ($customer->custMembership) {
                $customer->custMembership->delete();
            }

            $customer->delete();

            return response()->json(['msg' => "{$customer->custData->cust_name} deleted successfully!"]);
        });
    }
}

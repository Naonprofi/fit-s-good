<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Policies\CustomerPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Support\Facades\DB;

#[UsePolicy(CustomerPolicy::class)]
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        // Megkeressük a vevőt, aki a bejelentkezett userhez tartozik
        $customer = Customer::with(['custData', 'custContact', 'custMembership'])
            ->where('user_id', auth()->id())
            ->first();

        // Ha nincs ilyen (pl. még nem futott le a seeder erre a userre),
        // akkor ne dobjon hibát a Blade, hanem kezeljük le.
        if (! $customer) {
            return 'Hiba: Ehhez a felhasználóhoz nincs Customer profil rendelve az adatbázisban.';
        }

        return view('customers.profile', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $customer = Customer::where('user_id', auth()->id())->firstOrFail();

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        // 1. Validáció az összes mezőre a 3 táblából
        $validated = $request->validate([
            // CustData mezők
            'cust_name' => 'required|string|max:255',
            'cust_gender' => 'required|in:male,female,other',
            'cust_age' => 'required|integer|min:0',

            // CustContact mezők
            'cust_email' => 'required|email',
            'cust_phone_num' => 'required|string',
        ]);

        // 2. A fő Customer modell megkeresése
        $customer = Customer::findOrFail($customer->id);

        try {
            // 3. Tranzakció indítása: vagy minden sikerül, vagy semmi
            DB::transaction(function () use ($customer, $validated) {

                // Frissítés a CustData táblában
                // (Feltételezve, hogy a Customer modellben 'data' a kapcsolat neve)
                $customer->CustData()->update([
                    'cust_name' => $validated['cust_name'],
                    'cust_gender' => $validated['cust_gender'],
                    'cust_age' => $validated['cust_age'],
                ]);

                // Frissítés a CustContact táblában
                // (Feltételezve, hogy a Customer modellben 'contact' a kapcsolat neve)
                $customer->CustContact()->update([
                    'cust_email' => $validated['cust_email'],
                    'cust_phone_num' => $validated['cust_phone_num'],
                ]);

                // Ha a Customer táblának is van saját frissítendő adata:
                // $customer->update([...]);
            });

            return redirect()->route('home')->with('success', 'Sikeres frissítés!');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'Hiba történt: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustMembershipRequest;
use App\Http\Requests\UpdateCustMembershipRequest;
use App\Models\CustMembership;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

#[UsePolicy(CustMembershipPolicy::class)]
class CustMembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $customer = Customer::with('CustMembership')->where('user_id', $user->id)->first();

        if (! $customer || ! $customer->CustMembership || $customer->CustMembership->type === 'none') {
            return view('customers.membership');
        }

        return view('customers.membership_premium');
    }

    public function upgrade()
    {
        return view('customers.membership_upgrade');
    }

    public function finishPayment(Request $request)
    {
        $user = Auth::user();
        $customer = Customer::where('user_id', $user->id)->first();

        if ($customer) {
            $membership = CustMembership::find($customer->membership_id);
            $membership->update(['type' => 'premium']);
        }

        return redirect()->route('membership')->with('success', 'Payment successful! You are now a Premium member.');
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
    public function store(StoreCustMembershipRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CustMembership $custMembership)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustMembership $custMembership)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustMembershipRequest $request, CustMembership $custMembership)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustMembership $custMembership)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustContactRequest;
use App\Http\Requests\UpdateCustContactRequest;
use App\Models\CustContact;
use App\Policies\CustContactPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;

#[UsePolicy(CustContactPolicy::class)]

class CustContactController extends Controller
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
        $this->authorize('create', CustContact::class);

        return view('customers.edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustContactRequest $request)
    {
        CustContact::create($request->all());

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustContact $custContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustContact $custContact)
    {
        return view("customers.edit", ["custContact" => $custContact]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustContactRequest $request, CustContact $custContact)
    {
        $custContact->update($request->all());

        return redirect()->route("home");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustContact $custContact)
    {
        //
    }
}

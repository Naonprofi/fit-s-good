<?php

namespace App\Http\Controllers;

use App\Models\WorkerContact;
use App\Http\Requests\StoreWorkerContactRequest;
use App\Http\Requests\UpdateWorkerContactRequest;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
#[UsePolicy(WorkerContactPolicy::class)]
class WorkerContactController extends Controller
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
    public function store(StoreWorkerContactRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkerContact $workerContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkerContact $workerContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkerContactRequest $request, WorkerContact $workerContact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkerContact $workerContact)
    {
        //
    }
}

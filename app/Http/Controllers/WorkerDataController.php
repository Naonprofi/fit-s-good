<?php

namespace App\Http\Controllers;

use App\Models\WorkerData;
use App\Http\Requests\StoreWorkerDataRequest;
use App\Http\Requests\UpdateWorkerDataRequest;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
#[UsePolicy(WorkerDataPolicy::class)]
class WorkerDataController extends Controller
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
    public function store(StoreWorkerDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkerData $workerData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkerData $workerData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkerDataRequest $request, WorkerData $workerData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkerData $workerData)
    {
        //
    }
}

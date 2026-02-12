<?php

namespace App\Http\Controllers;

use App\Models\WorkerJobTitle;
use App\Http\Requests\StoreWorkerJobTitleRequest;
use App\Http\Requests\UpdateWorkerJobTitleRequest;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
#[UsePolicy(WorkerJobTitlePolicy::class)]
class WorkerJobTitleController extends Controller
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
    public function store(StoreWorkerJobTitleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkerJobTitle $workerJobTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkerJobTitle $workerJobTitle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkerJobTitleRequest $request, WorkerJobTitle $workerJobTitle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkerJobTitle $workerJobTitle)
    {
        //
    }
}

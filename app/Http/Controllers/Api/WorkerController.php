<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Models\WorkerContact;
use App\Models\WorkerData;
use App\Models\WorkerJobTitle;
use App\Models\WorkerSchedule;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Worker::class);
        $workers = Worker::with(['workerData', 'workerContact', 'workerJobTitle', 'workerSchedule'])->get();

        if ($workers->isEmpty()) {
            return response()->json([
                'msg' => 'there are no workers in the database',
            ], 404);
        }

        return response()->json($workers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $this->authorize('create', Worker::class);

        return DB::transaction(function () use ($request) {

            $data = WorkerData::create([
                'worker_name' => $request->name,
                'worker_age' => $request->age,
                'worker_gender' => $request->gender,
            ]);

            $contact = WorkerContact::create([
                'worker_email' => $request->email,
                'worker_phone_num' => $request->phone,
            ]);

            $job = WorkerJobTitle::create([
                'title' => $request->title,
            ]);

            $schedule = WorkerSchedule::create([
                'shift' => $request->shift,
            ]);

            $worker = Worker::create([
                'worker_data_id' => $data->id,
                'worker_contact_id' => $contact->id,
                'job_title_id' => $job->id,
                'schedule_id' => $schedule->id,
            ]);

            return response()->json([
                'msg' => 'Worker created successfully',
                'data' => $worker->load([
                    'workerData',
                    'workerContact',
                    'workerJobTitle',
                    'workerSchedule',
                ]),
            ], 201);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('view', Worker::class);
        $worker = Worker::with(['workerData', 'workerContact', 'workerJobTitle', 'workerSchedule'])->find($id);
        if (! $worker) {
            return response()->json(['msg' => "Worker with ID $id not found"], 404);
        }

        return response()->json($worker);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $worker = Worker::find($id);
        if (! $worker) {
            return response()->json(['msg' => 'Worker not found'], 404);
        }

        $this->authorize('update', $worker);

        return DB::transaction(function () use ($request, $worker) {

            if ($worker->workerData) {
                $worker->workerData->update([
                    'worker_name' => $request->name ?? $worker->workerData->worker_name,
                    'worker_age' => $request->age ?? $worker->workerData->worker_age,
                    'worker_gender' => $request->gender ?? $worker->workerData->worker_gender,
                ]);
            }

            if ($worker->workerContact) {
                $worker->workerContact->update([
                    'worker_email' => $request->email ?? $worker->workerContact->worker_email,
                    'worker_phone_num' => $request->phone ?? $worker->workerContact->worker_phone_num,
                ]);
            }

            if ($worker->workerJobTitle) {
                $worker->workerJobTitle->update([
                    'title' => $request->title ?? $worker->workerJobTitle->title,
                ]);
            }

            if ($worker->workerSchedule) {

                $worker->workerSchedule->update([
                    'shift' => $request->shift ?? $worker->workerSchedule->shift,
                ]);
            }

            return response()->json([
                'msg' => 'Worker updated successfully',
                'data' => $worker->load(['workerData', 'workerContact', 'workerJobTitle', 'workerSchedule']),
            ]);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {

        $worker = Worker::find($id);

        if (! $worker) {
            return response()->json(['msg' => "Worker with ID $id not found"], 404);
        }

        $this->authorize('delete', $worker);

        return DB::transaction(function () use ($worker) {

            if ($worker->workerData) {
                $worker->workerData->delete();
            }

            if ($worker->workerContact) {
                $worker->workerContact->update(['worker_email' => $worker->workerContact->worker_email.'_deleted_'.now()->timestamp]);
                $worker->workerContact->delete();
            }

            if ($worker->workerJobTitle) {
                $worker->workerJobTitle->delete();
            }

            if ($worker->workerSchedule) {
                $worker->workerSchedule->delete();
            }

            $worker->delete();

            return response()->json([
                'msg' => 'Worker and all related data soft-deleted successfully',
            ]);
        });
    }
}

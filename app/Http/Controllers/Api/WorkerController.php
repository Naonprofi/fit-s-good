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
            // 1. Adatok létrehozása
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

            // 2. A fő Worker rekord létrehozása a friss ID-kkal
            $worker = Worker::create([
                'worker_data_id' => $data->id,
                'worker_contact_id' => $contact->id,
                'job_title_id' => $job->id,
                'schedule_id' => $schedule->id,
            ]);

            // 3. Visszaadjuk a teljes objektumot az asztali appnak
            // FIGYELEM: Csak a modellben létező CamelCase neveket használd!
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
            // 1. Személyes adatok
            if ($worker->workerData) {
                $worker->workerData->update([
                    'worker_name' => $request->name ?? $worker->workerData->worker_name,
                    'worker_age' => $request->age ?? $worker->workerData->worker_age,
                    'worker_gender' => $request->gender ?? $worker->workerData->worker_gender,
                ]);
            }

            // 2. Elérhetőség
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

            // 4. Beosztás frissítése
            if ($worker->workerSchedule) {
                // Itt a 'shift' kulcsot használd, ha az van a tábládban
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
        // 1. Megkeressük a munkást
        $worker = Worker::find($id);

        if (! $worker) {
            return response()->json(['msg' => "Worker with ID $id not found"], 404);
        }

        // 2. Jogosultság ellenőrzése (Policy)
        $this->authorize('delete', $worker);

        // 3. Tranzakció, hogy minden kapcsolódó adat is soft-delete-elve legyen
        return DB::transaction(function () use ($worker) {

            // Mivel soft delete-ről van szó, a kapcsolódó tábláknál is
            // meg kell hívni a delete()-et, feltéve, hogy azokban is van softDeletes!

            if ($worker->workerData) {
                $worker->workerData->delete();
            }

            if ($worker->workerContact) {
                $worker->workerContact->update(['worker_email' => $worker->workerContact->worker_email.'_deleted_'.now()->timestamp]);
                $worker->workerContact->delete();
            }

            // A te migrációd szerinti kapcsolatnevekkel:
            if ($worker->workerJobTitle) {
                $worker->workerJobTitle->delete();
            }

            if ($worker->workerSchedule) {
                $worker->workerSchedule->delete();
            }

            // Végül magát a munkást is "töröljük"
            $worker->delete();

            return response()->json([
                'msg' => 'Worker and all related data soft-deleted successfully',
            ]);
        });
    }
}

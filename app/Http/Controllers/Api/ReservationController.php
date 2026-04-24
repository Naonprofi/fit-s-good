<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $res = Reservation::with([
            'customer.custData',
            'customer.custContact',
            'customer.custMembership',
            'table',
        ])->get();

        return response()->json($res);
    }

    public function todayReservationsSimple()
    {
        return Reservation::with('customer')
            ->whereDate('date', now())
            ->get()
            ->map(function ($r) {
                return [
                    'table_id' => $r->table_id,
                    'time' => $r->period,
                    'customer_name' => $r->customer->custData->cust_name ?? 'Guest',
                ];
            });
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $suitableTable = RestaurantTable::where('capacity', '=', $request->guests)
            ->where('status', 'free')
            ->orderBy('capacity', 'asc')
            ->first();

        if (! $suitableTable) {
            return response()->json(['msg' => 'No table'], 422);
        }

        $reservation = Reservation::create([
            'customer_id' => $request->customer_id,
            'date' => $request->date,
            'period' => $request->period,
            'guests' => $request->guests,
            'table_id' => $suitableTable->id,
        ]);

        return response()->json([
            'msg' => 'Reservation created successfully!',
            'reservation' => $reservation,
            'table_number' => $suitableTable->table_number,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $res = Reservation::with(['customer', 'table'])->find($id);
        if ($res) {
            return response()->json($res);
        }

        return response()->json(['msg' => 'Not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $res = Reservation::find($id);

        if (! $res) {
            return response()->json(['msg' => 'Not found'], 404);
        }

        $res->guests = $request->guests;

        $table = RestaurantTable::where('capacity', '>=', $request->guests)
            ->orderBy('capacity', 'asc')
            ->first();

        if ($table) {
            $res->table_id = $table->id;
        }

        $res->save();

        return response()->json(['msg' => 'Updated', 'reservation' => $res]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $res = Reservation::find($id);
        if ($res) {
            $res->delete();

            return response()->json(['msg' => 'Deleted']);
        }

        return response()->json(['msg' => 'Error'], 404);
    }
}

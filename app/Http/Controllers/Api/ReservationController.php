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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $suitableTable = RestaurantTable::where('capacity', '>=', $request->guests)
            ->where('status', 'free')
            ->orderBy('capacity', 'asc')
            ->first();

        if (! $suitableTable) {
            return response()->json(['msg' => 'No suitable table found.'], 422);
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
        if ($res) {
            $res->update(['guests' => $request->guests]);

            return response()->json(['msg' => 'Successful update']);
        }

        return response()->json(['msg' => 'Didnt find'], 404);
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

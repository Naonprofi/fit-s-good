<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
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
        ])->get();

        return response()->json($res);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

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

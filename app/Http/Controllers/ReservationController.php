<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateReservationRequest;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\RestaurantTable;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

#[UsePolicy(ReservationPolicy::class)]
class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $customer = Customer::where('user_id', $user->id)->first();

        $lastReservation = Reservation::where('customer_id', $customer->id)
            ->latest()
            ->first();

        $activeReservation = null;

        if ($lastReservation) {
            $startDateTime = Carbon::parse($lastReservation->period);
            $endDateTime = $startDateTime->copy()->addHours(2);

            $now = Carbon::now('Europe/Budapest');

            if ($now->lessThan($endDateTime)) {
                $activeReservation = $lastReservation;
            }
        }

        return view('customers.reservations', compact('activeReservation'));
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
    public function store(Request $request)
    {
        $customer = Customer::where('user_id', Auth::id())->first();

        if (! $customer) {
            return redirect()->back()->with('error', 'Customer not found!');
        }
        $start = Carbon::parse($request->date.' '.$request->period);
        $end = (clone $start)->addHours(2);

        $tables = RestaurantTable::where('capacity', '>=', $request->guests)
            ->orderBy('capacity', 'asc')
            ->get();

        $suitableTable = null;

        foreach ($tables as $table) {

            $conflict = Reservation::where('table_id', $table->id)
                ->where('date', $request->date)
                ->where(function ($q) use ($start, $end) {
                    $q->where('period', '<', $end)
                        ->where('end_time', '>', $start);
                })
                ->exists();

            if (! $conflict) {
                $suitableTable = $table;
                break;
            }
        }

        if (! $suitableTable) {
            return redirect()->back()->with('error', 'No available table for this time slot!');
        }

        Reservation::create([
            'customer_id' => $customer->id,
            'date' => $request->date,
            'period' => $start,
            'end_time' => $end,
            'guests' => $request->guests,
            'table_id' => $suitableTable->id,
        ]);

        return redirect()
            ->route('reservations')
            ->with('success', 'Table reserved successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}

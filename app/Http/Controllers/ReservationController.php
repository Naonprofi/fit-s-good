<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
            // JAVÍTÁS 2: Dátum és idő összefűzése a pontos vizsgálathoz
            // A $lastReservation->period már string, pl. "12:00"
            $startDateTime = \Carbon\Carbon::parse($lastReservation->date . ' ' . $lastReservation->period, 'Europe/Budapest');

            // Kiszámoljuk a végét (+2 óra)
            $endDateTime = $startDateTime->copy()->addHours(2);

            // JAVÍTÁS 1: Időzóna fixálása a mostani időnél is
            $now = \Carbon\Carbon::now('Europe/Budapest');

            // Ha a mostani idő még nem érte el a foglalás végét, akkor aktív
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

        // Dupla biztonsági ellenőrzés: van-e már aktív foglalása?
        $exists = Reservation::where('customer_id', $customer->id)
            ->where('date', '>=', Carbon::today()->toDateString())
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'You already have an active reservation!');
        }

        Reservation::create([
            'customer_id' => $customer->id,
            'date' => $request->date,
            'period' => $request->period,
            'guests' => $request->guests,
        ]);

        return redirect()->route('reservations')->with('success', 'Table reserved successfully!');
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

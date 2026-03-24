<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // app/Http/Controllers/ReservationController.php

public function store(Request $request)
{
    $validated = $request->validate([
        'date'   => 'required|date|after_or_equal:today',
        'period' => 'required|integer|min:6|max:20', // Itt korlátozzuk a nyitvatartást
        'guests' => 'required|integer|min:1|max:12',
    ]);

    $validated['customer_id'] = auth()->id();

    \App\Models\Reservation::create($validated);

    return redirect()->back()->with('success', 'Asztalfoglalásod rögzítettük!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

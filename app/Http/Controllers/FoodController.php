<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) // <--- Beadjuk a Request-et
{
    // 1. Elindítjuk a lekérdezést (még nem kérjük le az adatokat)
    $query = Food::query();

    // 2. Megnézzük, van-e a kategória szűrő az URL-ben (pl: ?category_id=1)
    if ($request->has('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 3. Most futtatjuk le a lekérdezést
    $foods = $query->get();

    // 4. Hibakezelés (opcionális, de maradhat)
    if ($foods->isEmpty()) {
        // Ha JSON-t akarsz visszaadni hiba esetén:
        // return response()->json(['msg' => 'No foods found'], 404);
        
        // VAGY inkább csak add át az üres listát a view-nak, 
        // a Blade-ben lévő @forelse majd kiírja, hogy nincs találat.
    }

    return view('menu.main', compact('foods'));
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
    //
}

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        //
    }
}

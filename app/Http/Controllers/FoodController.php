<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFoodRequest;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Food::query();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $foods = $query->get();

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

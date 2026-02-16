<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::all();

        // Az isEmpty() metódus nézi meg, hogy valóban üres-e a lista
        if ($foods->isEmpty()) {
            return response()->json([
                'msg' => 'there are no foods in the database',
            ], 404);
        }

        return response()->json($foods);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        // Ez fogja meghívni a Policy-t
        $this->authorize('create', Food::class);

        $food = Food::create($request->validated());

        return response()->json([
            'msg' => 'Created successfully',
            'data' => $food,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $food = Food::findOrFail($id);

        return response()->json($food);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, string $id)
    {
        $food = Food::findOrFail($id);
        $food->update($request->all());

        return response()->json(['msg' => "{$food->name} was updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $food = Food::findOrFail($id);
        $food->delete();

        return response()->json(['msg' => "{$food->name} was deleted"]);
    }
}

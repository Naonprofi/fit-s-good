<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Food;
use App\Policies\FoodPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;

#[UsePolicy(FoodPolicy::class)]
class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::all();
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
        $this->authorize('create', Food::class);
        $food = Food::create($request->validated());

        return response()->json([
            'msg' => 'Created successfully',
            'data' => $food,
        ], 201);

        return response()->json(['msg' => 'Unauthorized'], 403);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $foodName)
    {
        if ($food = Food::where('name', $foodName)->first()) {
            return response()->json($food);
        }

        return response()->json(['msg' => "$foodName not found"], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, string $foodName)
    {
        $this->authorize('update', Food::class);
        if ($food = Food::where('name', $foodName)->first()) {
            $food->update($request->all());

            return response()->json(['msg' => "{$food->name} was updated", 'data' => $food]);
        }

        return response()->json(['msg' => "$foodName not found"], 404);

        return response()->json(['msg' => 'Unauthorized'], 403);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $foodName)
    {
        $this->authorize('delete', Food::class);
        if ($food = Food::where('name', $foodName)->first()) {
            $food->delete();

            return response()->json(['msg' => "{$food->name} was deleted"]);
        }

        return response()->json(['msg' => "$foodName not found"], 404);

        return response()->json(['msg' => 'Unauthorized'], 403);

    }
}

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
    public function update(UpdateFoodRequest $request, $id)
    {
        $food = Food::find($id);

        if (! $food) {
            return response()->json(['msg' => 'Error: No such ID in the database: '.$id], 404);
        }
        $food->update($request->validated());

        return response()->json([
            'msg' => "Successfully updated: {$food->name}",
            'data' => $food,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $food = Food::find($id);
        if ($food) {
            $food->delete();

            return response()->json(['msg' => 'Deleted successfully']);
        }

        return response()->json(['msg' => 'Error, could not delete: '.$id], 404);
    }
}

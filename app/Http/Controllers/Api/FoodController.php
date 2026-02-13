<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::all();
        if (isset($foods) == false) {
            return response()->json(["msg" => "there are no foods in the database"], 404);
        }

        return response()->json($foods);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        Food::create($request->all());
        return response()->json(["msg" => "{$request->name} was created succesfully"]);
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
        return response()->json(["msg" => "{$food->name} was updated"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $food = Food::findOrFail($id);
        $food->delete();
        return response()->json(["msg" => "{$food->name} was deleted"]);
    }
}

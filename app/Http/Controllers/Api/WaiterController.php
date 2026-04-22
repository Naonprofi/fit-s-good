<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaiterController extends Controller
{
    public function getTables()
    {
        return RestaurantTable::all();
    }

    public function occupyTable(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:restaurant_tables,id',
        ]);

        $table = RestaurantTable::findOrFail($request->table_id);

        DB::transaction(function () use ($table) {

            $table->update(['status' => 'occupied']);

            // 🔥 EZ A LÉNYEG: mindig legyen order
            Order::firstOrCreate(
                [
                    'table_id' => $table->id,
                    'is_paid' => false,
                ],
                [
                    'total_amount' => 0,
                    'payment_method' => null,
                ]
            );
        });

        return response()->json(['success' => true]);
    }

    public function addItemsToOrder(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:restaurant_tables,id',
            'food_id' => 'required|exists:food,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $order = Order::firstOrCreate(
            [
                'table_id' => $request->table_id,
                'is_paid' => false,
            ],
            [
                'total_amount' => 0,
                'payment_method' => null,
            ]
        );

        $food = Food::findOrFail($request->food_id);

        OrderItem::create([
            'order_id' => $order->id,
            'food_id' => $food->id,
            'quantity' => $request->quantity,
            'price' => $food->price,
        ]);

        $total = OrderItem::where('order_id', $order->id)
            ->get()
            ->sum(fn ($i) => $i->price * $i->quantity);

        $order->update(['total_amount' => $total]);

        return response()->json(['success' => true]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:restaurant_tables,id',
            'payment_method' => 'required|in:cash,card',
        ]);

        $order = Order::where('table_id', $request->table_id)
            ->where('is_paid', false)
            ->first();

        if (! $order) {
            return response()->json([
                'error' => 'No active order found (should never happen now)',
            ], 404);
        }

        DB::transaction(function () use ($order, $request) {

            $total = OrderItem::where('order_id', $order->id)
                ->get()
                ->sum(fn ($i) => $i->price * $i->quantity);

            $order->update([
                'is_paid' => true,
                'payment_method' => $request->payment_method,
                'total_amount' => $total,
            ]);

            RestaurantTable::where('id', $order->table_id)
                ->update(['status' => 'free']);
        });

        return response()->json(['success' => true]);
    }

    public function getActiveOrderItems(Request $request)
    {
        $request->validate([
            'table_id' => 'required|exists:restaurant_tables,id',
        ]);

        $order = Order::where('table_id', $request->table_id)
            ->where('is_paid', false)
            ->first();

        if (! $order) {
            return response()->json([]);
        }

        return OrderItem::with('food')
            ->where('order_id', $order->id)
            ->get()
            ->map(function ($item) {
                return [
                    'food_name' => $item->food->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->price * $item->quantity,
                ];
            });
    }
}

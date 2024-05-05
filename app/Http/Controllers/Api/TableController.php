<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TableController extends Controller
{
    public function checkTableStatus($restaurant_name, $tableNumber)
    {
        $table = Table::where('TableNumber', $tableNumber)
            ->where('restaurant_name',$restaurant_name)
            ->with(['orders' => function ($query) {
                $query->where('order_status', 'pending');
            }])->first();

        if (!$table) {
            return response()->json(['message' => 'Table not found'], 404);
        }

        $isOccupied = $table->Status === 'Occupied'; // Assuming the field name is 'status'
        $hasPendingOrder = $table->orders->isNotEmpty();

        $response = [
            'isOccupied' => $isOccupied,
            'hasOrder' => $hasPendingOrder,
            // Assuming you want the ID of the first pending order if exists
            'orderId' => $hasPendingOrder ? $table->orders->first()->id : null,
        ];

        return response()->json($response);
    }

    public function getPendingOrdersForTable(Request $request, $restaurant_name,$tableId )
    {
        $orders = Order::with(['items', 'items.menu'])
            ->where('table_id', $tableId)
            ->where('order_status', 'pending')
            ->where('restaurant_name', $restaurant_name)
            ->get()
            ->map(function ($order) {
                $totalPrice = $order->items->reduce(function ($carry, $item) {
                    if ($item->menu) { // Check if menu item is not null
                        return $carry + ($item->quantity * $item->menu->price);
                    }
                    return $carry;
                }, 0);

                $items = $order->items->map(function ($item) {
                    if ($item->menu) { // Again, check if menu item is not null
                        return [
                            'name' => $item->menu->name,
                            'quantity' => $item->quantity,
                            'price' => $item->menu->price
                        ];
                    }
                    return null; // Or some default structure
                })->whereNotNull();

                return [
                    'orderId' => $order->id,
                    'totalPrice' => $totalPrice,
                    'items' => $items
                ];
            });
            Log::info("Fetching orders for table: $tableId, restaurant: $restaurant_name");

        Log::info('Orders fetched:', $orders->toArray()); // Log the orders array
        return response()->json(['orders' => $orders]);
    }

    // In TableController

    public function completeOrders($tableNumber,$restaurant_name)
    {

        $table = Table::where('tableNumber', $tableNumber)->where('restaurant_name',$restaurant_name)->first();

        if (!$table) {
            return response()->json(['message' => 'Table not found'], 404);
        }

        // Update all pending orders to 'completed' for this table
        $table->orders()->where('order_status', 'Pending')->where('restaurant_name',$restaurant_name)->update(['order_status' => 'complete']);

        // Update table status to 'Available'
        $table->update(['Status' => 'Available']);

        return response()->json(['message' => 'Orders completed and table status updated']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Models\Table;

class TableController extends Controller
{
    public function index()
    {
        // Fetch all tables from the database
        $tables = Table::all();

        // Pass tables to the view
        return view('table.index', ['tables' => $tables]);
    }

    public function getPendingOrdersForTable(Request $request, $tableId,$restaurant_name)
    {
        $orders = Order::with(['items', 'items.menuItem'])
                        ->where('table_id', $tableId)
                        ->where('order_status', 'pending')
                        ->where('restaurant_name', $restaurant_name)
                        ->get()
                        ->map(function ($order) {
                            $totalPrice = $order->items->reduce(function ($carry, $item) {
                                return $carry + ($item->quantity * $item->menuItem->price);
                            }, 0);
                            return [
                                'orderId' => $order->id,
                                'totalPrice' => $totalPrice,
                                'items' => $order->items->map(function ($item) {
                                    return [
                                        'name' => $item->menuItem->name,
                                        'quantity' => $item->quantity,
                                        'price' => $item->menuItem->price
                                    ];
                                })
                            ];
                        });

        return response()->json(['orders' => $orders]);
    }
    public function updateStatus(Request $request, $tableId)
    {
        // Update the status of the table
        $table = Table::findOrFail($tableId);
        $table->status = $request->status; // You may want to validate and sanitize this input
        $table->save();

        // Redirect back with a success message
        return redirect()->route('table.index')->with('success', 'Table status updated successfully!');
    }
    public function destroy($tableId)
    {
        // Find the table by ID and delete it
        $table = Table::findOrFail($tableId);
        $table->delete();

        // Redirect back to the table index page with a success message
        return redirect()->route('table.index')->with('success', 'Table deleted successfully!');
    }
}

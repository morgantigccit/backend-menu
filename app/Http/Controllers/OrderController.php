<?php

namespace App\Http\Controllers;

use App\Events\OrderUpdated;
use App\Models\Menu;
use App\Notifications\NewRequestNotification;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function index()
{
    $orders = Order::with(['items.menu'])->get(); // Assuming there's a 'menu' relationship defined on your OrderItem model

    return view('admin.orders.index', compact('orders'));
}

public function fetchOrders()
{
    $userRestaurantName = auth()->user()->restaurant_name;

    $orders = Order::where('restaurant_name',$userRestaurantName)->with('items.menu')->get(); // Adjust based on your actual relationships

    return response()->json($orders);
}


public function getOrderDetails($orderId)
{
    Log::info("Fetching order details for Order ID: {$orderId}");

    // Attempt to fetch the order with its items and associated menu details
    $order = Order::with(['items.menu'])->where('id', $orderId)->first();
    // $item_order=OrderItem
    if (!$order) {
        return response()->json([
            'message' => 'Order not found.',
        ], 404);
    }

    return response()->json($order);
}

public function placeOrder(Request $request, $restaurant_name)
{

    Log::info('Starting to place an order.0001' );

    $validated = $request->validate([
        'table_id' => 'required',
        'items' => 'required|array|min:1',
        'items.*.MenuItemID' => 'required|exists:menus,MenuItemID',
        'items.*.quantity' => 'required|integer|min:1',
        'total_price' => 'required|numeric|min:0',
    ]);
    event(new OrderUpdated($validated['table_id'], $restaurant_name));
    Log::info('Starting to place an order.0002'.$validated['table_id'] );

    // Attempt to find an existing pending order for the specified table
    $existingOrder = Order::where([
        ['table_id', '=', $validated['table_id']],
        ['order_status', '=', 'pending'],
        ['restaurant_name', '=', $restaurant_name],
    ])->first();

    DB::beginTransaction();
    try {
        if ($existingOrder) {
            Log::info("Found existing order with ID: {$existingOrder->id}");

            foreach ($validated['items'] as $requestedItem) {
                $menuItem = Menu::where('MenuItemID', $requestedItem['MenuItemID'])->firstOrFail(); // Ensure menu item exists

                // Check if the item already exists in the order
                $existingItem = $existingOrder->items()->where('MenuItemID', $requestedItem['MenuItemID'])->first();

                if ($existingItem) {
                    // If item exists, update its quantity
                    $existingItem->quantity += $requestedItem['quantity'];
                    $existingItem->save();
                } else {
                    // If item doesn't exist, add it as a new order item
                    $existingOrder->items()->create([
                        'MenuItemID' => $requestedItem['MenuItemID'],
                        'quantity' => $requestedItem['quantity'],
                    ]);
                }

                // Update the order's total price
                $existingOrder->total_price += $menuItem->price * $requestedItem['quantity'];
            }

            $existingOrder->save();
        } else {
            Log::info('No existing order found. Creating a new order.'.$validated['table_id']);

            $order = Order::create([
                'table_id' => $validated['table_id'],
                'restaurant_name' => $restaurant_name,
                'total_price' => 0, // Initialize total price to 0, it will be updated below
                'order_status' => 'pending',
            ]);
            // $orderDetails = [
            //     'tableNumber' => $validated['table_id'],
            //     // Include other necessary details
            // ];

            $orderTotalPrice = 0;

            foreach ($validated['items'] as $item) {
                $menuItem = Menu::where('MenuItemID', $item['MenuItemID'])->firstOrFail(); // Ensure menu item exists

                $order->items()->create([
                    'MenuItemID' => $item['MenuItemID'],
                    'quantity' => $item['quantity'],
                ]);

                // Update the cumulative total price of the order
                $orderTotalPrice += $menuItem->price * $item['quantity'];
            }

            // Set the correct total price for the order
            $order->total_price = $orderTotalPrice;
            $order->save();
        }

        DB::commit();
        return response()->json(['message' => 'Order processed successfully'], 201);
    } catch (\Throwable $e) {
        DB::rollback();
        Log::error('Error processing order: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to process the order', 'exception' => $e->getMessage()], 500);
    }
}


    public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required', // Ensure these are the correct status options for your application
    ]);

    $order->update([
        'order_status' => $request->status,
    ]);

    return back()->with('success', 'Order status updated successfully.');
}

}

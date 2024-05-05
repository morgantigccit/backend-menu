<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function sendEmail(Request $request)
    {
        $tableId = $request->tableNumber;
        $restaurant_name = $request->restaurant_name;
        $email = $request->email;

        // Fetch orders similar to how you're handling it in the TableController
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

        Log::info("Attempting to send invoice email for table: $tableId at $restaurant_name to $email");

        if ($orders->isEmpty()) {
            Log::info("No pending orders found for table: $tableId at $restaurant_name");
            return response()->json(['message' => 'No pending orders to invoice.'], 404);
        }

        try {
            Mail::to($email)->send(new InvoiceMail([
                'orders' => $orders,
                'tableNumber' => $tableId,
                'restaurantName' => $restaurant_name
            ]));
            Log::info('Orders fetched invoice controller :', $orders->toArray());
            Log::info("Invoice email sent successfully for table: $tableId at $restaurant_name");
            return response()->json(['message' => 'Invoice sent successfully!'], 200);
        } catch (\Exception $e) {
            Log::error('Failed to send invoice email:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to send email, please try again.', 'error' => $e->getMessage()], 500);
        }
    }
}

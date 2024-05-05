<?php

namespace App\Http\Controllers\Api;

use App\Events\WaiterCalled;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WaiterCall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WaiterNotificationController extends Controller
{
    public function notify(Request $request)
    {
        $tableNumber = $request->input('table_number');
        $restaurant_name = $request->input('restaurant_name');
        $type = $request->input('type'); // New attribute

        // Log the notification
        Log::info("Waiter called for table: {$tableNumber}");
        Log::info("Waiter called for table: {$restaurant_name}");
        Log::info("Waiter called for table: {$type}");

        // Store the notification in the database
        $waiterCall = new WaiterCall();
        $waiterCall->table_number = $tableNumber;
        $waiterCall->restaurant_name = $restaurant_name;
        $waiterCall->type = $type; // Assign the value of 'type'
        $waiterCall->save();
        $EmailUser = User::where('restaurant_name', $restaurant_name)->get("email");
        // Optionally, broadcast an event for real-time dashboard updates
        event(new WaiterCalled($tableNumber, $restaurant_name));

        return response()->json(['success' => true, 'message' => "Waiter has been notified for table {$tableNumber}"]);
    }

    public function fetch()
    {
        $userRestaurantName = auth()->user()->restaurant_name;

        // Fetch waiter calls from the database
        $waiterCalls = WaiterCall::where('restaurant_name', $userRestaurantName)->get(); // Adjust the query as needed

        return response()->json(["status" => "success", "data" => $waiterCalls]);
    }
}

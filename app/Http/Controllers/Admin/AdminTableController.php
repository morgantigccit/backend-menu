<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\Waiter; // Add the Waiter model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRestaurantName = auth()->user()->restaurant_name;
        $tables = Table::where('restaurant_name', $userRestaurantName)->with('waiter')->get();

        return view('admin.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new table.
     */
    public function create()
    {
        $restaurantName = auth()->user()->restaurant_name;
        $waiters = Waiter::where('restaurant_name', $restaurantName)->get(); // Fetch all waiters to be selected in the view
     
        return view('admin.tables.create', compact('waiters'));
    }

    /**
     * Store a newly created table in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'TableNumber' => 'required',
            'Status' => 'required',
            'waiter_id' => 'nullable|exists:waiters,id', // Make sure the waiter_id exists in the waiters table or is nullable
        ]);

        $table = new Table();
        $table->TableNumber = $request->TableNumber;
        $table->status = $request->Status;
        $table->waiter_id = $request->waiter_id; // Assign waiter to the table
        $table->restaurant_name = $user->restaurant_name;
        $table->save();

        return redirect()->route('admin.table.index')->with('success', 'Table added successfully');
    }

    /**
     * Show the form for editing the specified table.
     */
    public function edit($table_id)
    {
        $userRestaurantName = auth()->user()->restaurant_name;
        $table = Table::where('id', $table_id)->where('restaurant_name', $userRestaurantName)->firstOrFail();
        $waiters = Waiter::where('restaurant_name', $userRestaurantName)->get(); // Fetch all waiters to be selected in the view

        return view('admin.tables.edit', compact('table', 'waiters'));
    }

    public function destroy($tableId)
    {
        $table = Table::findOrFail($tableId);
        $table->delete();

        return redirect()->route('admin.table.index')->with('success', 'Table deleted successfully!');
    }

    /**
     * Update the specified table in storage.
     */
    public function update(Request $request, $table_id)
    {
        $request->validate([
            'TableNumber' => 'required',
            'Status' => 'required',
            'waiter_id' => 'nullable|exists:waiters,id', // Validation for waiter_id
        ]);

        $userRestaurantName = auth()->user()->restaurant_name;
        $table = Table::where('id', $table_id)->where('restaurant_name', $userRestaurantName)->firstOrFail();

        $table->TableNumber = $request->TableNumber;
        $table->status = $request->Status;
        $table->waiter_id = $request->waiter_id; // Update the assigned waiter
        $table->save();

        return redirect()->route('admin.table.index')->with('success', 'Table updated successfully');
    }
}

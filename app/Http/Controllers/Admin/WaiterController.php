<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Waiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewRequestNotification;
use App\Models\User; // Make sure this points to your actual User model

class WaiterController extends Controller
{
    public function index()
    {
        $restaurantName = auth()->user()->restaurant_name;
        $waiters = Waiter::where('restaurant_name', $restaurantName)->get();

        return view('admin.waiters.index', compact('waiters'));
    }

    public function create()
    {
        return view('admin.waiters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            // Assuming restaurant_name is automatically set based on the authenticated user's associated restaurant
        ]);

        Waiter::create([
            'name' => $request->name,
            'position' => $request->position,
            'restaurant_name' => auth()->user()->restaurant_name,
        ]);

        // Notify all logged-in users about the new waiter
        // $loggedInUsers = User::auth();
        // Notification::send($loggedInUsers, new NewRequestNotification($request));

        return redirect()->route('admin.waiters.index')->with('success', 'Waiter added successfully');
    }

    public function show($id)
    {
        $restaurantName = auth()->user()->restaurant_name;
        $waiter = Waiter::where('id', $id)->where('restaurant_name', $restaurantName)->firstOrFail();

        return view('admin.waiters.show', compact('waiter'));
    }

    public function edit($id)
    {
        $restaurantName = auth()->user()->restaurant_name;
        $waiter = Waiter::where('id', $id)->where('restaurant_name', $restaurantName)->firstOrFail();

        return view('admin.waiters.edit', compact('waiter'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
        ]);

        $restaurantName = auth()->user()->restaurant_name;
        $waiter = Waiter::where('id', $id)->where('restaurant_name', $restaurantName)->firstOrFail();

        $waiter->update([
            'name' => $request->name,
            'position' => $request->position,
        ]);

        return redirect()->route('admin.waiters.index')->with('success', 'Waiter updated successfully');
    }

    public function destroy($id)
    {
        $restaurantName = auth()->user()->restaurant_name;
        $waiter = Waiter::where('id', $id)->where('restaurant_name', $restaurantName)->firstOrFail();

        $waiter->delete();

        return redirect()->route('admin.waiters.index')->with('success', 'Waiter deleted successfully');
    }
}

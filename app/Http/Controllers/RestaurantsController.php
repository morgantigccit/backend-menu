<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class RestaurantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */// Import at the top of your controller file

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:restaurants,name',
        'address' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'phone' => 'nullable|string|max:255',
        'website' => 'nullable|url|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Allow only images
    ]);

    // Handle file upload for logo
    $logoName = null;
    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $logoName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/restaurants'), $logoName);
    }

    // Create a unique slug for the restaurant
    $slug = Str::slug($request->name, '-');
    // Ensure the slug is unique by appending numbers if necessary
    $count = Restaurant::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
    $slug = $count ? "{$slug}-{$count}" : $slug;

    $restaurant = new Restaurant([
        'name' => $request->get('name'),
        'address' => $request->get('address'),
        'city' => $request->get('city'),
        'state' => $request->get('state'),
        'phone' => $request->get('phone'),
        'website' => $request->get('website'),
        'logo' => $logoName, // Store the filename of the uploaded logo
        'slug' => $slug, // Store the generated unique slug
    ]);
    $restaurant->save();

    return redirect()->route('admin.restaurants.index')->with('success', 'Restaurant created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            // Add other fields as necessary
        ]);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->name = $request->get('name');
        $restaurant->location = $request->get('location');
        // Update other fields as necessary
        $restaurant->save();

        return redirect()->route('restaurants.index')->with('success', 'Restaurant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return redirect()->route('restaurants.index')->with('success', 'Restaurant deleted successfully.');
    }
}

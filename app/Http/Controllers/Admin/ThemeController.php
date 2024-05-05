<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{

    public function index()
    {
        $restaurant_name = Auth::user()->restaurant_name;

        $themes = Theme::where('restaurant_name',$restaurant_name)->get();
        return view('admin.themes.index', compact('themes'));
    }

    /**
     * Show the form for creating a new theme.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.themes.create');
    }

    /**
     * Store a newly created theme in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        // Retrieve the restaurant name from the authenticated user
        $restaurant_name = Auth::user()->restaurant_name;

        // Only pass the validated and necessary data to the create method
        $theme = Theme::create([
            'name' => $request->name,
            'description' => $request->description,
            'restaurant_name' => $restaurant_name  // Assigning the restaurant_name from the authenticated user
        ]);

        return redirect()->route('admin.themes.index')->with('success', 'Theme created successfully.');
    }
    /**
     * Display the specified theme.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $theme = Theme::findOrFail($id);
        return view('admin.themes.show', compact('theme'));
    }

    /**
     * Show the form for editing the specified theme.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $theme = Theme::findOrFail($id);
        return view('admin.themes.edit', compact('theme'));
    }

    /**
     * Update the specified theme in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'restaurant_name' => 'required|string|exists:restaurants,name'
        ]);

        $theme = Theme::findOrFail($id);
        $theme->update($request->all());
        return redirect()->route('admin.themes.index')->with('success', 'Theme updated successfully.');
    }

    /**
     * Remove the specified theme from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theme = Theme::findOrFail($id);
        $theme->delete();
        return redirect()->route('admin.themes.index')->with('success', 'Theme deleted successfully.');
    }

    /**
     * Activate a specific theme and deactivate others for the restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id)
    {
        $theme = Theme::findOrFail($id);
        $theme->activate(); // Assuming you have an 'activate' method defined in your model that handles this
        return redirect()->route('admin.themes.index')->with('success', 'Theme activated successfully.');
    }
    //
}

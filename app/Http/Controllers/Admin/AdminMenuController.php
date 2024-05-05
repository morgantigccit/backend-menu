<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch menu items that belong to the user's restaurant only
        $userRestaurantName = auth()->user()->restaurant_name;
        $menuItems = Menu::where('restaurant_name', $userRestaurantName)
                         ->with('category')->paginate(10);
        return view('admin.menus.index', compact('menuItems'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $userRestaurantName = auth()->user()->restaurant_name;

        $categories = Category::where('restaurant_name', $userRestaurantName)->get(); // Assuming category access isn't restricted by restaurant
        return view('admin.menus.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,category_id', // Corrected column name assumption to 'id'
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('assets/images'), $filename);
            $validatedData['image'] = 'assets/images/' . $filename;
        }

        $validatedData['restaurant_name'] = $user->restaurant_name;

        Menu::create($validatedData);

        return redirect()->route('admin.menus.index')->with('success', 'Menu item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($MenuItemID)
    {
        $userRestaurantName = auth()->user()->restaurant_name;
        $menuItem = Menu::where('MenuItemID', $MenuItemID)
                        ->where('restaurant_name', $userRestaurantName)
                        ->with('category')->firstOrFail();
        return view('admin.menus.show', compact('menuItem'));
    }

    // Show the form for editing the specified resource.
    public function edit($MenuItemID)
    {
        $userRestaurantName = auth()->user()->restaurant_name;
        $menuItem = Menu::where('MenuItemID', $MenuItemID)
                        ->where('restaurant_name', $userRestaurantName)->firstOrFail();
        $categories = Category::all(); // Assuming category access isn't restricted by restaurant
        return view('admin.menus.edit', compact('menuItem', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $MenuItemID)
    {
        $userRestaurantName = auth()->user()->restaurant_name;
        $menuItem = Menu::where('MenuItemID', $MenuItemID)
                        ->where('restaurant_name', $userRestaurantName)->firstOrFail();

        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,category_id',
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Update image handling as needed
            if ($menuItem->image && file_exists(public_path($menuItem->image))) {
                File::delete(public_path($menuItem->image));
            }

            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('assets/images'), $filename);
            $validatedData['image'] = 'assets/images/' . $filename;
        }

        $menuItem->update($validatedData);

        return redirect()->route('admin.menus.index')->with('success', 'Menu item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($MenuItemID)
    {
        $userRestaurantName = auth()->user()->restaurant_name;
        $menuItem = Menu::where('MenuItemID', $MenuItemID)
                        ->where('restaurant_name', $userRestaurantName)->firstOrFail();

        if ($menuItem->image) {
            $imagePath = public_path($menuItem->image);
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }
        }

        $menuItem->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu item deleted successfully.');
    }
}

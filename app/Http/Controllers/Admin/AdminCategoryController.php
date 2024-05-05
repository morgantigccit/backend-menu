<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCategoryController extends Controller
{
    //testing for github push and pull requests testing
    // Display a listing of the categories
    public function index()
    {
        $userRestaurantName = auth()->user()->restaurant_name;
        $categories = Category::where('restaurant_name', $userRestaurantName)->get();
        return view('admin.categories.index', compact('categories'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store a newly created category in storage
    public function store(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'slug' => 'nullable',
            'description' => 'required',
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name'], '-');
        $validatedData['restaurant_name'] = $user->restaurant_name; // Set restaurant_name based on the authenticated user

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('assets/images'), $filename);
            $validatedData['image'] = 'assets/images/' . $filename;
        }

        Category::create($validatedData);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Show the form for editing the specified category
    public function edit($category_id)
    {
        $userRestaurantName = auth()->user()->restaurant_name;
        $category = Category::where('category_id', $category_id)->where('restaurant_name', $userRestaurantName)->firstOrFail();
        return view('admin.categories.edit', compact('category'));
    }

    // Update the specified category in storage
    public function update(Request $request, $category_id)
    {
        $userRestaurantName = auth()->user()->restaurant_name;
        $category = Category::where('category_id', $category_id)->where('restaurant_name', $userRestaurantName)->firstOrFail();

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'slug' => 'nullable',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $oldImagePath = public_path($category->image);
            if (file_exists($oldImagePath)) {
                @unlink($oldImagePath);
            }

            $file = $request->file('image');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('assets/images'), $filename);
            $validatedData['image'] = 'assets/images/' . $filename;
        }

        if (empty($validatedData['slug'])) {
            $validatedData['slug'] = Str::slug($validatedData['name'], '-');
        }

        $category->update($validatedData);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function show($category_id)
    {
        $userRestaurantName = auth()->user()->restaurant_name;
        $category = Category::where('id', $category_id)->where('restaurant_name', $userRestaurantName)->firstOrFail();
        return view('admin.categories.show', compact('category'));
    }

    // Remove the specified category from storage
    public function destroy($category_id)
    {
        $userRestaurantName = auth()->user()->restaurant_name;

        // Find the category
        $category = Category::where('category_id', $category_id)
                            ->where('restaurant_name', $userRestaurantName)
                            ->firstOrFail();

        // Delete related menu items
        Menu::where('category_id', $category_id)->delete();

        // Delete the category
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

}

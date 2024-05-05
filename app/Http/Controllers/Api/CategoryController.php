<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


        // Get all categories
        public function index($restaurant_name)
        {
            // Retrieve the restaurant name from the request

            if (!$restaurant_name) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Restaurant name is required.'
                ], 400); // Bad request
            }

            // Fetch categories that belong to the specified restaurant and are active
            $categories = Category::where('status', 'active')
                                   ->where('restaurant_name', $restaurant_name)
                                   ->get();

            if ($categories->isNotEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $categories
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "Categories not found for the restaurant named '{$restaurant_name}'."
                ], 404);
            }
        }

        // Store a new category
    }

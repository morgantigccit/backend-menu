<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    // Store a new review
    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|string|max:255',
            'message' => 'required|string',
            "restaurant_name" => "required|string",
            'rate' => 'required|string',
        ]);

        $review = Review::create($request->all());

        return response()->json($review, 201);
    }

    // Retrieve all reviews
    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }

    // Add other methods as necessary, such as show, update, and delete
}

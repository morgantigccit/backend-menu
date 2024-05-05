<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //

    public function index(){
        $restaurantName = auth()->user()->restaurant_name;
        $reviews=Review::where('restaurant_name',$restaurantName)->get();
        return view('admin.review.index',compact('reviews'));
    }
}

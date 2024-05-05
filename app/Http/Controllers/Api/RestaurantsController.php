<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantsController extends Controller
{
    public function index($name){
        $restaurants = Restaurant::where('name', $name)->get();

        if(!$restaurants){
        return response()->json(["message" => "Restaurant not found"], 404);
        }
        return response()->json($restaurants);
    }
}

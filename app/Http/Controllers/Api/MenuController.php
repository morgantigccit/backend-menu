<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function index(Request $request)
    {
        $category_id = $request->category_id;

        if ($category_id) {
            $menuItems = Menu::where('category_id', $category_id)->with('category')->get();
        } else {
            $menuItems = Menu::with('category')->get();
        }

        return response()->json([
            'status' => 'success',
            'data' => $menuItems
        ], 200);
    }
}

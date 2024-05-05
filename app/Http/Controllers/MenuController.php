<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Fetch menu items from the database
        $menuItems = Menu::all();

        // Pass menu items to the view
        return response()->json($menuItems);
    }
}

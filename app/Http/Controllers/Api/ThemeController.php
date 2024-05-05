<?php

namespace App\Http\Controllers\Api;

use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThemeController extends Controller
{
    public function getActiveThemeByRestaurant($restaurant_name)
    {
        $activeTheme = Theme::where('restaurant_name', $restaurant_name)
                            ->where('is_active', true)
                            ->first();

        if ($activeTheme) {
            return response()->json($activeTheme);
        } else {
            return response()->json(['message' => 'No active theme found for the specified restaurant'], 404);
        }
    }
}

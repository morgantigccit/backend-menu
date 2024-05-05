<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Table;
use App\Models\WaiterCall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userRestaurantName = Auth::user()->restaurant_name;

        // Now filtering each count by restaurant name
        $categoriesCount = Category::where('restaurant_name', $userRestaurantName)->count();
        $menuItemsCount = Menu::where('restaurant_name', $userRestaurantName)->count();
        $tablesCount = Table::where('restaurant_name', $userRestaurantName)->count();
        $waiterCallsCount = WaiterCall::where('restaurant_name', $userRestaurantName)->count();

        // Filter orders by restaurant name as well
        $ordersStatusCount = Order::where('restaurant_name', $userRestaurantName)
                                  ->select('order_status', DB::raw('count(*) as total'))
                                  ->groupBy('order_status')
                                  ->get()
                                  ->keyBy('order_status');

        // Filter current month orders by restaurant name
        $currentMonthOrders = Order::where('restaurant_name', $userRestaurantName)
                                   ->whereMonth('created_at', date('m'))
                                   ->whereYear('created_at', date('Y'))
                                   ->get();

        $monthlyKPIs = [
            'totalOrders' => $currentMonthOrders->count(),
            'totalRevenue' => $currentMonthOrders->sum('total_price'),
            'averageOrderValue' => $currentMonthOrders->avg('total_price')
        ];

        return view('admin.dashboard.index', compact('categoriesCount', 'menuItemsCount', 'tablesCount', 'waiterCallsCount', 'ordersStatusCount', 'monthlyKPIs'));
    }
}

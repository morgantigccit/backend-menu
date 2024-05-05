    <?php

    use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\InvoiceController;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\RestaurantsController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SubscriberController;
use App\Http\Controllers\Api\TableController;
use App\Http\Controllers\Api\ThemeController;
use App\Http\Controllers\Api\WaiterNotificationController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\OrderController;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "api" middleware group. Make something great!
    |
    */

    // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    // });
    Route::post('/orders/placeorder/{restaurant_name}', [OrderController::class, 'placeOrder']);
    Route::get('/menu', [MenuController::class, 'index']);
    // Route::get('/categories', [CategoryController::class, 'index']);

    Route::get('/categories/{restaurant_name}', [CategoryController::class, 'index']);
    // Route::get('/get-order-details/{orderId}', [OrderController::class, 'getOrderDetails']);
    Route::get('/carts/{cart}', [CartController::class, 'show']); // Show cart
    Route::get('/orders/{orderId}/details', [OrderController::class, 'getOrderDetails']);

    Route::post('/carts', [CartController::class, 'store']); // Create a new cart
    Route::post('/cart-items', [CartController::class, 'addItem']); // Add item to cart
    Route::delete('/cart-items/{cartItem}', [CartController::class, 'removeItem']); // Remove item from cart
    Route::post('/carts/{cart}/checkout', [CartController::class, 'checkout']); // Checkout cart
    Route::post('/notify-waiter', [WaiterNotificationController::class, 'notify'])->name('notify.waiter');

    Route::get('/tables/{restaurant_name}/{tableNumber}/status', [TableController::class, 'checkTableStatus']);

    Route::get('/orders/pending/{restaurant_name}/{tableId}', [TableController::class, 'getPendingOrdersForTable'])->name('api.getPendingOrders.fetch');

    Route::post('/tables/{restaurant_name}/{tableNumber}/completeOrders', [TableController::class, 'completeOrders']);
    Route::delete('/table/{tableId}', [TableController::class, 'destroy'])->name('table.destroy');
    Route::get('/restaurants/{name}', [RestaurantsController::class, 'index'])->name('restaurants.index');
    Route::post('/send-email', [InvoiceController::class, 'sendEmail']);
    Route::post('/subscribe/email', [SubscriberController::class, 'store']);

    Route::get('themes/active/{restaurant_name}', [ThemeController::class, 'getActiveThemeByRestaurant']);


    Route::get('/reviews', [ReviewController::class, 'index']);
    Route::post('/reviews', [ReviewController::class, 'store']);

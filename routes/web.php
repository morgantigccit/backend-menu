<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminTableController;
use App\Http\Controllers\Admin\AdminWaiterController;
use App\Http\Controllers\Admin\CreateUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\WaiterController;
use App\Http\Controllers\AdminThemeController;
use App\Http\Controllers\Api\WaiterNotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', function () {
    return redirect()->route('login');
});

// Admin Routes
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Admin Resto Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('themes', ThemeController::class);
        Route::post('themes/{theme}/activate', [ThemeController::class, 'activate'])->name('themes.activate');
    });
    // Admin Category Routes
    Route::get('admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('admin/review', [ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::get('admin/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('admin/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('admin/categories/{id}', [AdminCategoryController::class, 'show'])->name('admin.categories.show');
    Route::get('admin/categories/{category_id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('admin/categories/{category_id}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('admin/categories/{category_id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');


    // Waiters
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/waiters', [WaiterController::class, 'index'])->name('waiters.index');
        Route::get('/waiters/create', [WaiterController::class, 'create'])->name('waiters.create');
        Route::post('/waiters', [WaiterController::class, 'store'])->name('waiters.store');
        Route::get('/waiters/{waiter}', [WaiterController::class, 'show'])->name('waiters.show');
        Route::get('/waiters/{waiter}/edit', [WaiterController::class, 'edit'])->name('waiters.edit');
        Route::put('/waiters/{waiter}', [WaiterController::class, 'update'])->name('waiters.update');
        Route::delete('/waiters/{waiter}', [WaiterController::class, 'destroy'])->name('waiters.destroy');
    });

    // Admin Menu Routes
    Route::get('admin/menus', [AdminMenuController::class, 'index'])->name('admin.menus.index');
    Route::get('admin/menus/create', [AdminMenuController::class, 'create'])->name('admin.menus.create');
    Route::post('admin/menus', [AdminMenuController::class, 'store'])->name('admin.menus.store');
    Route::get('admin/menus/{id}', [AdminMenuController::class, 'show'])->name('admin.menus.show');
    Route::get('admin/menus/{id}/edit', [AdminMenuController::class, 'edit'])->name('admin.menus.edit');
    Route::put('admin/menus/{id}', [AdminMenuController::class, 'update'])->name('admin.menus.update');
    Route::delete('admin/menus/{id}', [AdminMenuController::class, 'destroy'])->name('admin.menus.destroy');

    Route::get('admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::post('/orders/{order}/status/update', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    // Route to display all subscribers
    Route::get('/admin/subscribers', [SubscriberController::class, 'index'])->name('admin.subscribers.index');

    // Route to display a single subscriber
    Route::get('/admin/subscribers/{id}', [SubscriberController::class, 'show'])->name('admin.subscribers.show');

    Route::get('/admin/subscriber/email', [SubscriberController::class, 'emailForm'])->name('admin.subscribers.email');

    Route::post('/admin/subscribers/email/send', [SubscriberController::class, 'sendEmailToAll'])->name('admin.subscribers.email.send');

    // Admin Table Routes
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::get('admin/tables', [AdminTableController::class, 'index'])->name('admin.table.index');
    Route::get('admin/tables/create', [AdminTableController::class, 'create'])->name('admin.table.create');
    Route::post('admin/tables/store', [AdminTableController::class, 'store'])->name('admin.table.store');
    Route::get('admin/tables/{table_id}/edit', [AdminTableController::class, 'edit'])->name('admin.table.edit');
    Route::put('admin/tables/{table_id}', [AdminTableController::class, 'update'])->name('admin.table.update');
    Route::delete('admin/tables/{table_id}', [AdminTableController::class, 'destroy'])->name('admin.table.delete');
});
Route::middleware(['auth', 'SuperAdmin'])->group(
    function () {
        Route::get('admin/restaurants', [RestaurantsController::class, 'index'])->name('admin.restaurants.index');
        Route::get('admin/restaurants/create', [RestaurantsController::class, 'create'])->name('admin.restaurants.create');
        Route::post('admin/restaurants', [RestaurantsController::class, 'store'])->name('admin.restaurants.store');
        Route::get('admin/restaurants/{id}', [RestaurantsController::class, 'show'])->name('admin.restaurants.show');
        Route::get('admin/restaurants/{id}/edit', [RestaurantsController::class, 'edit'])->name('admin.restaurants.edit');
        Route::put('admin/restaurants/{id}', [RestaurantsController::class, 'update'])->name('admin.restaurants.update');
        Route::delete('admin/restaurants/{id}', [RestaurantsController::class, 'destroy'])->name('admin.restaurants.destroy');
        Route::get('admin/users/creates', [CreateUserController::class, 'create'])->name('admin.users.create');
        Route::get('admin/users/{user}/edit', [CreateUserController::class, 'edit'])->name('admin.users.edit');
        Route::patch('admin/users/{user}', [CreateUserController::class, 'update'])->name('admin.users.update');
        Route::get('admin/users/index', [CreateUserController::class, 'index'])->name('admin.users.index');
        Route::post('admin/users/store', [CreateUserController::class, 'store'])->name('admin.users.store');
        Route::delete('admin/users/{user}', [CreateUserController::class, 'destroy'])->name('admin.users.destroy');
    }
);
// Authentication Routes
Auth::routes();
// Route::get('/login', [App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');
Route::get('/admin/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('admin.register');
// Route::get('/admin/register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('admin.register');
// Route::get('/send-test-email', function () {
//     Mail::raw('This is a test email using SendGrid from Laravel!', function ($message) {
//         $message->to('abdelkarimhamd@gmail.com')->subject('Test Email');
//     });

//     return 'Email sent!';
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Place this in routes/api.php for API route or routes/web.php for web route
Route::get('/orders/fetch', [OrderController::class, 'fetchOrders'])->name('orders.fetch');
Route::get('/waiter-calls/fetch', [WaiterNotificationController::class, 'fetch'])->name('api.waiter-calls.fetch');

Broadcast::routes(['middleware' => ['auth']]);

Route::middleware(['checkrole:user'])->group(function () {
    // Routes for users here
});

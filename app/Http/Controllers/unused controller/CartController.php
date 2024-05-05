<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// app/Http/Controllers/CartController.php

use App\Models\CartItem;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId, $quantity)
    {
        // Retrieve the cart items from the session
        $cart = $request->session()->get('cart', []);

        // Check if the item already exists in the cart
        foreach ($cart as &$item) {
            if ($item['product_id'] == $productId) {
                // If the item exists, update the quantity
                $item['quantity'] += $quantity;
                $request->session()->put('cart', $cart);
                return redirect()->route('cart.view')->with('success', 'Item added to cart');
            }
        }

        // If the item doesn't exist, add it to the cart
        $cart[] = [
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $request->input('price'), // You should retrieve the product price from your products table
        ];

        $request->session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Item added to cart');
    }

    public function viewCart(Request $request)
    {
        // Retrieve the cart items from the session
        $cartItems = $request->session()->get('cart', []);

        return view('cart.view', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        // Retrieve and clear the cart items from the session
        $orderDetails = $request->session()->get('cart', []);
        // TODO: Implement logic to create an order based on $orderDetails
        // Clear the session cart after placing the order
        $request->session()->forget('cart');

        return redirect()->route('cart.view')->with('success', 'Order placed successfully');
    }
}


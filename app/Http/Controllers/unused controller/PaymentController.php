<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// app/Http/Controllers/PaymentController.php

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Calculate the total amount for the order (you might need to fetch this from the database)
        $order = Order::find($request->orderId);
        $totalAmount = $this->calculateTotalAmount($order);

        // Integrate with a payment gateway (e.g., Stripe)
        // Stripe::setApiKey(config('services.stripe.secret_key'));

        // // Create a PaymentIntent
        // $paymentIntent = PaymentIntent::create([
        //     'amount' => $totalAmount,
        //     'currency' => 'usd', // Adjust based on your currency
        // ]);

        // Create a Payment record in the database
        Payment::create([
            'OrderID' => $order->id,
            'amount' => $totalAmount,
            'payment_status' => 'pending', // You can update this based on the payment gateway response
            'payment_method' => 'stripe', // You can adjust this based on the payment gateway used
        ]);

        // return view('payment.process', ['clientSecret' => $paymentIntent->client_secret]);
    }

    private function calculateTotalAmount(Order $order)
    {
        // Logic to calculate the total amount based on order items
        // You may need to fetch prices from the database and calculate the total
    }
}

<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if (!session('cart') || count(session('cart')) == 0) {
            return redirect('/cart')->with('error', 'Your cart is empty');
        }

        return view('frontend.checkout');
    }

    public function placeOrder(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Please login to place order');
        }
        $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required|regex:/^01[0-9]{9}$/',
            'address' => 'required|min:10',
            'payment_method' => 'required|in:cod',
        ]);

        $cart = session('cart');

        if (!$cart || count($cart) == 0) {
            return redirect('/cart')->with('error', 'Cart is empty');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $total,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        session()->forget('cart');
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Order placed successfully (Cash on Delivery)');
    }

}

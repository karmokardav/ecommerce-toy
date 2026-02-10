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
        return view('frontend.checkout');
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'address'=>'required'
        ]);

        $cart = session('cart');
        $total = 0;

        foreach($cart as $item){
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'total'=>$total,
        ]);

        foreach($cart as $item){
            OrderItem::create([
                'order_id'=>$order->id,
                'product_name'=>$item['name'],
                'price'=>$item['price'],
                'quantity'=>$item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect('/')->with('success','Order placed successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Order list
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.order.index', compact('orders'));
    }

    // Order details
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $items = OrderItem::where('order_id', $id)->get();

        return view('admin.order.show', compact('order', 'items'));
    }

    // Update status
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->payment_status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated');
    }
}

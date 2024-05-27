<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        if ($orders) {
            return view('frontend.order.index', compact('orders'));
        }
        else {
            return redirect()->route('index')->with('message', 'You have no ordered items');
        }
    }

    public function show($order)
    {
        $user = Auth::user();
        $order = Order::findOrFail($order);

        $orderItems = $order->orderItems;
        return view('frontend.order.show', compact('orderItems', 'order'));
    }
}

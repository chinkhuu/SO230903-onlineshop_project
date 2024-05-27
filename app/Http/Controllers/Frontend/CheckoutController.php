<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart_data = Cart::with('product')->where('user_id', $user->id)->get();

        $total_price = $cart_data->sum(function ($item) {
            return $item->quantity * $item->product->price * (1 - $item->product->sale_percent / 100);
        });

        return view('frontend.checkout', compact('cart_data', 'total_price'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        if (Auth::check()) {
            $user = Auth::user();

            $validatedData = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email',
                'phone_number' => 'required|numeric|digits:8',
                'district' => 'required|string|max:255',
                'khoroo' => 'required|numeric',
                'address' => 'required|string',
            ]);

            if ($user->cartItems)
            {
                $order = Order::create([
                    'user_id' => $user->id,
                    'firstname' => $validatedData['firstname'],
                    'lastname' => $validatedData['lastname'],
                    'email' => $validatedData['email'],
                    'phone_number' => $validatedData['phone_number'],
                    'district' => $validatedData['district'],
                    'khoroo' => $validatedData['khoroo'],
                    'address' => $validatedData['address'],
                ]);


                foreach ($user->cartItems as $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                        'price' => $cartItem->product->price,
                        'sale_percent' => $cartItem->product->sale_percent,
                    ]);
                }

                Cart::where('user_id', $user->id)->delete();

                return redirect()->route('index')->with('success','Check your order, the purchase is successful');
            }
            else
            {
                return redirect()->route('index')->with('error', 'Please add items to cart');
            }
        } else {
            return redirect()->route('index')->with('error', 'Please login first');
        }

    }
}

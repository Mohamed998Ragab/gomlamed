<?php

namespace App\Http\Controllers\Checkout;

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
        $selectedLanguage = app()->getLocale();
        $cartItems = Cart::where('user_id', Auth::id())->with('product.translations.language')->get();
        return view('front.checkout.checkout', compact('cartItems', 'selectedLanguage'));
    }

    public function placeOrder(Request $request)
{
    $request->validate([
        'address' => 'required|string|max:255'
    ]);

    $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
    }

    // Calculate the total price with discount
    $totalPrice = $cartItems->sum(function($item) {
        $finalPrice = $item->product->discount > 0
            ? $item->product->price * ((100 - $item->product->discount) / 100)
            : $item->product->price;
        return $finalPrice * $item->quantity;
    });

    $order = Order::create([
        'user_id' => Auth::id(),
        'address' => $request->address,
        'total_price' => $totalPrice,
        'status' => 'pending'
    ]);

    foreach ($cartItems as $item) {
        $finalPrice = $item->product->discount > 0
            ? $item->product->price * ((100 - $item->product->discount) / 100)
            : $item->product->price;

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $finalPrice
        ]);

        // Optionally, reduce product quantity here
        // $item->product->decrement('quantity', $item->quantity);
    }

    // Clear user's cart
    Cart::where('user_id', Auth::id())->delete();

    return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
}



    // public function placeOrder(Request $request)
    // {
    //     $request->validate([
    //         'address' => 'required|string|max:255'
    //     ]);

    //     $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

    //     if ($cartItems->isEmpty()) {
    //         return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
    //     }

    //     $totalPrice = $cartItems->sum(function($item) {
    //         return $item->product->price * $item->quantity;
    //     });

    //     $order = Order::create([
    //         'user_id' => Auth::id(),
    //         'address' => $request->address,
    //         'total_price' => $totalPrice,
    //         'status' => 'pending'
    //     ]);

    //     foreach ($cartItems as $item) {
    //         OrderItem::create([
    //             'order_id' => $order->id,
    //             'product_id' => $item->product_id,
    //             'quantity' => $item->quantity,
    //             'price' => $item->product->price
    //         ]);

    //         // Optionally, reduce product quantity here
    //         // $item->product->decrement('quantity', $item->quantity);
    //     }

    //     // Clear user's cart
    //     Cart::where('user_id', Auth::id())->delete();

    //     return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    // }
}

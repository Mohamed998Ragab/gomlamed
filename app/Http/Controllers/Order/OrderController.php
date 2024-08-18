<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $selectedLanguage = app()->getLocale();
        $orders = Order::where('user_id', Auth::id())->with('orderItems.product.translations.language')->get();
        return view('front.order.order', compact('orders', 'selectedLanguage'));
    }

    public function show($id)
    {
        $selectedLanguage = app()->getLocale();
        $order = Order::where('user_id', Auth::id())->with('orderItems.product.translations.language')->findOrFail($id);
        // dd($order);
        return view('front.order.show', compact('order', 'selectedLanguage'));
    }
}

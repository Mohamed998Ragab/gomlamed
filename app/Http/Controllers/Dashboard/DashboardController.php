<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }

    public function showAllCarts()
    {
        $carts = Cart::with(['product.translations.language', 'user'])->get()->groupBy('user_id');
        $selectedLanguage = app()->getLocale();

        return view('admin.cart.cart', compact('carts', 'selectedLanguage'));
    }
}

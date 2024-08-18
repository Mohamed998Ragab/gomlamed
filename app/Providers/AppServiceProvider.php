<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    //  public function boot(): void
    // {
    //      View::composer('front.layouts.layout', function ($view) {
    //          // Define default values for cart count and total
    //             $cartCount = 0;
    //             $cartTotal = 0.00;
    //          // If the user is authenticated, calculate the cart values
    //          if (Auth::check()) {
    //              $cartItems = Cart::where('user_id', Auth::id())->get();
    //              $cartCount = $cartItems->sum('quantity');
    //              $cartTotal = $cartItems->sum(function($item) {
    //                  return $item->quantity * $item->product->price;
    //              });
    //         }
     
    //          // Pass the variables to the view
    //          $view->with(compact('cartCount', 'cartTotal'));
             
    //      });
    // }

    public function boot(): void
    {
        View::composer('front.layouts.layout', function ($view) {
            $cartCount = 0;
            $cartTotal = 0.00;
    
            if (Auth::check()) {
                $cartItems = Cart::where('user_id', Auth::id())->get();
                $cartCount = $cartItems->sum('quantity');
                $cartTotal = $cartItems->sum(function($item) {
                    $product = $item->product; // Load product details
                    $finalPrice = $product->discount > 0 
                        ? max($product->price - $product->discount, 0) 
                        : $product->price;
                    return $item->quantity * $finalPrice;
                });
            }
    
            $view->with(compact('cartCount', 'cartTotal'));
        });
    }
    


}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Category;
use App\Models\FirstBanner;
use App\Models\Product;
use App\Models\SecondBanner;
use App\Models\Slider;
use App\Models\Language;
use App\Models\ThirdBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FrontController extends Controller
{
    public function index() {

        $selectedLanguage = app()->getLocale();
        $sliders = Slider::with('translations.language')->get();
        $firstBanner = FirstBanner::with('translations.language')->first();
        $secondBanner = SecondBanner::with('translations.language')->take(3)->get();
        $thirdBanner = ThirdBanner::with('translations.language')->take(3)->get();
        $categories = Category::with('translations.language')->take(4)->get();
        $blogs = Blog::with('translations.language')->take(4)->get();
        $products = Product::with('translations.language')->take(6)->get();
        // Fetch only the top products
        $topProducts = Product::whereHas('topProduct')->with('translations.language')->paginate(8);
        
        return view('front.home.home', compact('selectedLanguage','sliders','firstBanner','secondBanner', 'thirdBanner', 'categories', 'blogs', 'products', 'topProducts'));
    }

    public function shop(Request $request) {
        $selectedLanguage = app()->getLocale();
    
        // Fetch categories for the sidebar
        $categories = Category::with('translations.language')->get();
    
        // Start query for products
        $query = Product::with('translations.language');
    
        // Apply category filter if selected
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }
    
        // Apply search filter if a search term is provided
        if ($request->has('search') && $request->search) {
            $query->whereHas('translations', function($q) use ($request, $selectedLanguage) {
                $q->where('language_id', Language::where('code', $selectedLanguage)->first()->id)
                  ->where('title', 'like', '%' . $request->search . '%');
            });
        }
    
        // Paginate the results
        $products = $query->paginate(12);
    
        return view('front.shop.shop', compact('selectedLanguage', 'products', 'categories'));
    }
    

    public function singleProduct($id) {
        $selectedLanguage = app()->getLocale();
        $product = Product::find($id);
        return view('front.shop.single')->with(compact('selectedLanguage', 'product'));
    }

    public function about() {
        $selectedLanguage = app()->getLocale();
        $about = About::with('translations.language')->first();
        $secondBanner = SecondBanner::with('translations.language')->take(3)->get();

        return view('front.about.about')->with(compact('selectedLanguage', 'about', 'secondBanner'));
    }

    public function blog() {
        $selectedLanguage = app()->getLocale();
        $blogs = Blog::with('translations.language')->paginate(12);

        return view('front.blog.blog')->with(compact('selectedLanguage', 'blogs'));
    }

    public function singleBlog($id) {
        $selectedLanguage = app()->getLocale();
        $blog = Blog::find($id);
        return view('front.blog.single')->with(compact('selectedLanguage', 'blog'));
    }

    public function contact() {
        $selectedLanguage = app()->getLocale();

        return view('front.contact.contact')->with(compact('selectedLanguage'));
    }

    public function viewCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('product.translations.language')->get();
        $selectedLanguage = app()->getLocale();

        return view('front.cart.cart', compact('cartItems', 'selectedLanguage'));
    }

    // public function addToCart(Request $request)
    // {

    //         // Check if the user is authenticated
    //     if (!Auth::check()) {
    //         // If the request is an AJAX request
    //         if ($request->ajax()) {
    //             return response()->json(['message' => 'You need to log in first.'], 401);
    //         }

    //         // Otherwise, redirect to the login page
    //         return redirect()->route('login')->with('error', 'You need to log in first.');
    //     }
        
    //     $request->validate([
    //         'product_id' => 'required|exists:products,id',
    //         'quantity' => 'required|integer|min:1'
    //     ]);

    //     $product = Product::findOrFail($request->product_id);
    //     // $finalPrice = $product->discount > 0 
    //     //     ? $product->price * ((100 - $product->discount) / 100) 
    //     //     : $product->price;
    //     $finalPrice = $product->discount > 0 
    //         ? $product->price - $product->discount 
    //         : $product->price;
    
    //     $cartItem = Cart::where('user_id', Auth::id())
    //                     ->where('product_id', $request->product_id)
    //                     ->first();
    
    //     if ($cartItem) {
    //         // If the product is already in the cart, update the quantity
    //         $cartItem->quantity += $request->quantity;
    //         $cartItem->price = $finalPrice;
    //         $cartItem->save();
    //     } else {
    //         // If the product is not in the cart, create a new cart item
    //         Cart::create([
    //             'user_id' => Auth::id(),
    //             'product_id' => $request->product_id,
    //             'quantity' => $request->quantity,
    //             'price' => $finalPrice
    //         ]);
    //     }

    //     $cartItems = Cart::where('user_id', Auth::id())->get();
    //     $cartCount = $cartItems->sum('quantity');
    //     $cartTotal = $cartItems->sum(function($item) {
    //         return $item->quantity * $item->price;
    //     });
    
    //         if ($request->ajax()) {
    //             return response()->json([
    //             'message' => 'Product added to cart successfully!',
    //             'cartCount' => $cartCount,
    //             'cartTotal' => $cartTotal ?? 0
    //         ]);
    //     }

    //     return redirect()->route('cart.view')->with('success', 'Product added to cart successfully!');
    // }
    


    public function addToCart(Request $request)
    {
        try {
            if (!Auth::check()) {
                if ($request->ajax()) {
                    return response()->json(['message' => 'You need to log in first.'], 401);
                }
    
                return redirect()->route('login')->with('error', 'You need to log in first.');
            }
            
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);
    
            $product = Product::findOrFail($request->product_id);
    
            $cartItem = Cart::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->first();
    
            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity
                ]);
            }
    
            $cartItems = Cart::where('user_id', Auth::id())->get();
            $cartCount = $cartItems->sum('quantity');
            $cartTotal = $cartItems->sum(function($item) {
                $product = $item->product; // Load product details
                $finalPrice = $product->discount > 0 
                    ? max($product->price - $product->discount, 0) 
                    : $product->price;
                return $item->quantity * $finalPrice;
            });
    
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'Product added to cart successfully!',
                    'cartCount' => $cartCount,
                    'cartTotal' => $cartTotal
                ]);
            }
    
            return redirect()->route('cart.view')->with('success', 'Product added to cart successfully!');
        } catch (\Exception $e) {
            Log::error('Add to cart error: '.$e->getMessage());
    
            if ($request->ajax()) {
                return response()->json(['message' => 'An error occurred. Please try again.'], 500);
            }
    
            return redirect()->route('cart.view')->with('error', 'An error occurred. Please try again.');
        }
    }
    

    public function updateCart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1'
        ]);
    
        $cart = Cart::find($request->cart_id);
    
        if (!$cart) {
            return redirect()->route('cart.view')->with('error', 'Cart item not found.');
        }
    
        // Update the quantity only
        $cart->update([
            'quantity' => $request->quantity
        ]);
    
        // Calculate the new total price in case the view needs it
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $cartTotal = $cartItems->sum(function($item) {
            $product = $item->product; // Load product details
            $finalPrice = $product->discount > 0 
                ? max($product->price - $product->discount, 0) 
                : $product->price;
            return $item->quantity * $finalPrice;
        });
    
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Cart updated successfully!',
                'cartTotal' => $cartTotal
            ]);
        }
    
        return redirect()->route('cart.view')->with('success', 'Cart updated successfully!');
    }
    

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id'
        ]);

        Cart::where('id', $request->cart_id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->route('cart.view')->with('success', 'Product removed from cart successfully!');
    }

}

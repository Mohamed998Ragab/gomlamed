<?php

use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\About\AboutTranslationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Blog\BlogTranslationController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\CategoryTranslationController;
use App\Http\Controllers\Checkout\CheckoutController;
use App\Http\Controllers\Contact\ContactController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\DashboardOrder\OrderDashboardController;
use App\Http\Controllers\FirstBanner\FirstBannerController;
use App\Http\Controllers\FirstBanner\FirstBannerTranslationController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductTranslationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecondBanner\SecondBannerController;
use App\Http\Controllers\SecondBanner\SecondBannerTranslationController;
use App\Http\Controllers\Slider\SliderTranslationController;
use App\Http\Controllers\ThirdBanner\ThirdBannerController;
use App\Http\Controllers\ThirdBanner\ThirdBannerTranslationController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group([
    'middleware' => 'setLanguage',
], function () {

    // Guest-only routes (for unauthenticated users)
    Route::middleware('guest')->group(function () {
        Route::get('login', [CustomAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [CustomAuthController::class, 'login']);

        Route::get('register', [CustomAuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [CustomAuthController::class, 'register']);
    });

    // Authenticated-only routes
    Route::middleware('auth')->group(function () {
        Route::post('logout', [CustomAuthController::class, 'logout'])->name('logout');
    });
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/', [FrontController::class, 'index']);
    Route::get('/blog', [FrontController::class, 'blog']);
    Route::get('/singleBlog/{id}', [FrontController::class, 'singleBlog']);
    Route::get('/about', [FrontController::class, 'about']);
    Route::get('/shop', [FrontController::class, 'shop'])->name('shop');
    Route::get('/singleProduct/{id}', [FrontController::class, 'singleProduct']);
    Route::get('/contact', [FrontController::class, 'contact']);

    Route::middleware('auth.redirect')->group(function () {
        // Cart

        Route::post('/cart/add', [FrontController::class, 'addToCart'])->name('cart.add');
        Route::get('/cart', [FrontController::class, 'viewCart'])->name('cart.view');
        Route::post('/cart/update', [FrontController::class, 'updateCart'])->name('cart.update');
        Route::post('/cart/remove', [FrontController::class, 'removeFromCart'])->name('cart.remove');

        //Checkout
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    });

});




    Route::get('/set-language/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return redirect()->back();
    })->name('setLanguage');

Route::group([
    'prefix' => 'admin',
    'middleware' => 'CheckUserType',
], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/dashboard/cart', [DashboardController::class, 'showAllCarts'])->name('dashboard.cart');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/deleteUser/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/addUser', [UserController::class, 'addUser'])->name('admin.addUser');

    Route::get('/admins', [AdminController::class, 'index'])->name('admin.admins.index');
    Route::delete('/deleteAdmin/{id}', [AdminController::class, 'destroy'])->name('admin.admins.destroy');
    Route::post('/addAdmin', [AdminController::class, 'addAdmin'])->name('admin.addAdmin');


    // First Slider 

    Route::get('slider', [SliderController::class, 'index']);
    Route::get('addslider', [SliderController::class, 'addPage']);
    Route::post('slider', [SliderController::class, 'store']);
    Route::get('slider/{id}', [SliderController::class, 'editPage']);
    Route::post('slider/{id}', [SliderController::class, 'update']);
    Route::get('deleteSlider/{id}', [SliderController::class, 'destroy']);

    //Translation 

    Route::prefix('sliders/{sliderId}/translations')->group(function () {
        Route::get('/', [SliderTranslationController::class, 'index'])->name('sliders.translations.index');
        Route::get('create', [SliderTranslationController::class, 'create'])->name('sliders.translations.create');
        Route::post('/', [SliderTranslationController::class, 'store'])->name('sliders.translations.store');
        Route::get('{id}/edit', [SliderTranslationController::class, 'edit'])->name('sliders.translations.edit');
        Route::put('{id}', [SliderTranslationController::class, 'update'])->name('sliders.translations.update');
        Route::delete('{id}', [SliderTranslationController::class, 'destroy'])->name('sliders.translations.destroy');
    });
    
    
    // First Banner 

    Route::get('firstBanner', [FirstBannerController::class, 'index']);
    Route::get('addFirstBanner', [FirstBannerController::class, 'addPage']);
    Route::post('firstBanner', [FirstBannerController::class, 'store']);
    // Route::get('firstBanner/{id}', [FirstBannerController::class, 'editPage']);
    // Route::post('firstBanner/{id}', [FirstBannerController::class, 'update']);
    Route::get('deleteFirstBanner/{id}', [FirstBannerController::class, 'destroy']);

    //Translation 

    Route::prefix('firstBanners/{firstBannerId}/translations')->group(function () {
        Route::get('/', [FirstBannerTranslationController::class, 'index'])->name('firstBanners.translations.index');
        Route::get('create', [FirstBannerTranslationController::class, 'create'])->name('firstBanners.translations.create');
        Route::post('/', [FirstBannerTranslationController::class, 'store'])->name('firstBanners.translations.store');
        Route::get('{id}/edit', [FirstBannerTranslationController::class, 'edit'])->name('firstBanners.translations.edit');
        Route::put('{id}', [FirstBannerTranslationController::class, 'update'])->name('firstBanners.translations.update');
        Route::delete('{id}', [FirstBannerTranslationController::class, 'destroy'])->name('firstBanners.translations.destroy');
    });

    // Second Banner 

    Route::get('secondBanner', [SecondBannerController::class, 'index']);
    Route::get('addSecondBanner', [SecondBannerController::class, 'addPage']);
    Route::post('secondBanner', [SecondBannerController::class, 'store']);
    Route::get('secondBanner/{id}', [SecondBannerController::class, 'editPage']);
    Route::post('secondBanner/{id}', [SecondBannerController::class, 'update']);
    Route::get('deleteSecondBanner/{id}', [SecondBannerController::class, 'destroy']);

    
    //Translation 

    Route::prefix('secondBanners/{secondBannerId}/translations')->group(function () {
        Route::get('/', [SecondBannerTranslationController::class, 'index'])->name('secondBanners.translations.index');
        Route::get('create', [SecondBannerTranslationController::class, 'create'])->name('secondBanners.translations.create');
        Route::post('/', [SecondBannerTranslationController::class, 'store'])->name('secondBanners.translations.store');
        Route::get('{id}/edit', [SecondBannerTranslationController::class, 'edit'])->name('secondBanners.translations.edit');
        Route::put('{id}', [SecondBannerTranslationController::class, 'update'])->name('secondBanners.translations.update');
        Route::delete('{id}', [SecondBannerTranslationController::class, 'destroy'])->name('secondBanners.translations.destroy');
    });

    // Third Banner 

    Route::get('thirdBanner', [ThirdBannerController::class, 'index']);
    Route::get('addThirdBanner', [ThirdBannerController::class, 'addPage']);
    Route::post('thirdBanner', [ThirdBannerController::class, 'store']);
    Route::get('thirdBanner/{id}', [ThirdBannerController::class, 'editPage']);
    Route::post('thirdBanner/{id}', [ThirdBannerController::class, 'update']);
    Route::get('deleteThirdBanner/{id}', [ThirdBannerController::class, 'destroy']);

    //Translation 

    Route::prefix('thirdBanners/{thirdBannerId}/translations')->group(function () {
        Route::get('/', [ThirdBannerTranslationController::class, 'index'])->name('thirdBanners.translations.index');
        Route::get('create', [ThirdBannerTranslationController::class, 'create'])->name('thirdBanners.translations.create');
        Route::post('/', [ThirdBannerTranslationController::class, 'store'])->name('thirdBanners.translations.store');
        Route::get('{id}/edit', [ThirdBannerTranslationController::class, 'edit'])->name('thirdBanners.translations.edit');
        Route::put('{id}', [ThirdBannerTranslationController::class, 'update'])->name('thirdBanners.translations.update');
        Route::delete('{id}', [ThirdBannerTranslationController::class, 'destroy'])->name('thirdBanners.translations.destroy');
    });

    
    // Category 

    Route::get('category', [CategoryController::class, 'index']);
    Route::get('addCategory', [CategoryController::class, 'addPage']);
    Route::post('category', [CategoryController::class, 'store']);
    Route::get('category/{id}', [CategoryController::class, 'editPage']);
    Route::post('category/{id}', [CategoryController::class, 'update']);
    Route::get('deleteCategory/{id}', [CategoryController::class, 'destroy']);

    //Translation 

    Route::prefix('categories/{categoryId}/translations')->group(function () {
        Route::get('/', [CategoryTranslationController::class, 'index'])->name('categories.translations.index');
        Route::get('create', [CategoryTranslationController::class, 'create'])->name('categories.translations.create');
        Route::post('/', [CategoryTranslationController::class, 'store'])->name('categories.translations.store');
        Route::get('{id}/edit', [CategoryTranslationController::class, 'edit'])->name('categories.translations.edit');
        Route::put('{id}', [CategoryTranslationController::class, 'update'])->name('categories.translations.update');
        Route::delete('{id}', [CategoryTranslationController::class, 'destroy'])->name('categories.translations.destroy');
    });

    // Blog 

    Route::get('blog', [BlogController::class, 'index']);
    Route::get('addBlog', [BlogController::class, 'addPage']);
    Route::post('blog', [BlogController::class, 'store']);
    Route::get('blog/{id}', [BlogController::class, 'editPage']);
    Route::post('blog/{id}', [BlogController::class, 'update']);
    Route::get('deleteBlog/{id}', [BlogController::class, 'destroy']);

    //Translation 

    Route::prefix('blogs/{blogId}/translations')->group(function () {
        Route::get('/', [BlogTranslationController::class, 'index'])->name('blogs.translations.index');
        Route::get('create', [BlogTranslationController::class, 'create'])->name('blogs.translations.create');
        Route::post('/', [BlogTranslationController::class, 'store'])->name('blogs.translations.store');
        Route::get('{id}/edit', [BlogTranslationController::class, 'edit'])->name('blogs.translations.edit');
        Route::put('{id}', [BlogTranslationController::class, 'update'])->name('blogs.translations.update');
        Route::delete('{id}', [BlogTranslationController::class, 'destroy'])->name('blogs.translations.destroy');
    });

    // About 

    Route::get('about', [AboutController::class, 'index']);
    Route::get('addAbout', [AboutController::class, 'addPage']);
    Route::post('about', [AboutController::class, 'store']);
    Route::get('about/{id}', [AboutController::class, 'editPage']);
    Route::post('about/{id}', [AboutController::class, 'update']);
    Route::get('deleteAbout/{id}', [AboutController::class, 'destroy']);

    //Translation 

    Route::prefix('abouts/{aboutId}/translations')->group(function () {
        Route::get('/', [AboutTranslationController::class, 'index'])->name('abouts.translations.index');
        Route::get('create', [AboutTranslationController::class, 'create'])->name('abouts.translations.create');
        Route::post('/', [AboutTranslationController::class, 'store'])->name('abouts.translations.store');
        Route::get('{id}/edit', [AboutTranslationController::class, 'edit'])->name('abouts.translations.edit');
        Route::put('{id}', [AboutTranslationController::class, 'update'])->name('abouts.translations.update');
        Route::delete('{id}', [AboutTranslationController::class, 'destroy'])->name('abouts.translations.destroy');
    });

    // Product

    Route::get('product', [ProductController::class, 'index']);
    Route::get('addProduct', [ProductController::class, 'addPage']);
    Route::post('product', [ProductController::class, 'store']);
    Route::get('product/{id}', [ProductController::class, 'editPage']);
    Route::post('product/{id}', [ProductController::class, 'update']);
    Route::get('deleteProduct/{id}', [ProductController::class, 'destroy']);
    Route::get('/productSearch', [ProductController::class, 'search'])->name('admin.product.search');
    Route::post('admin/product/{product}/toggleTopProduct', [ProductController::class, 'toggleTopProduct'])->name('admin.product.toggleTopProduct');



    //Translation 

    Route::prefix('products/{productId}/translations')->group(function () {
        Route::get('/', [ProductTranslationController::class, 'index'])->name('products.translations.index');
        Route::get('create', [ProductTranslationController::class, 'create'])->name('products.translations.create');
        Route::post('/', [ProductTranslationController::class, 'store'])->name('products.translations.store');
        Route::get('{id}/edit', [ProductTranslationController::class, 'edit'])->name('products.translations.edit');
        Route::put('{id}', [ProductTranslationController::class, 'update'])->name('products.translations.update');
        Route::delete('{id}', [ProductTranslationController::class, 'destroy'])->name('products.translations.destroy');
    });

    // Order
    Route::get('/orders', [OrderDashboardController::class, 'index'])->name('admin.orders.index');
    Route::post('/orders/{id}/status', [OrderDashboardController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::get('/orders/{id}', [OrderDashboardController::class, 'viewOrder'])->name('admin.orders.show');
    Route::delete('/orders/{id}', [OrderDashboardController::class, 'destroy'])->name('admin.orders.destroy');
    Route::get('/ordersSearch', [OrderDashboardController::class, 'search'])->name('admin.orders.search');


    //Contact 

    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php';

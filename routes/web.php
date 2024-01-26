<?php

use App\Http\Controllers\Frontend\NewsLetterController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ProductTrackController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserVendorrequestController;
use App\Http\Controllers\Frontend\WishListController;

require __DIR__ . '/auth.php';

// User Dashboard Routes Group
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {

    // User Dashboard
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');

    // User Address Route
    Route::resource('address', UserAddressController::class);

    //Checkout Route
    Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout');
    Route::post('checkout/address-create', [CheckOutController::class, 'checkoutCreateAddress'])->name('checkout.create.address');
    Route::post('checkout/form-submit', [CheckOutController::class, 'checkoutFormSubmit'])->name('checkout.form-submit');

    //Payment Route
    Route::get('payment', [PaymentController::class, 'payment'])->name('payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    //Paypal Route
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');
    
   // cash on delivery routes
   Route::get('/cod.payment', [PaymentController::class, 'payWithCod'])->name('cod-payment');
    //Stripe Route
    Route::post('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');

    // Orders route
    Route::get('orders', [UserOrderController::class, 'index'])->name('orders');
    Route::get('orders/show/{id}', [UserOrderController::class, 'show'])->name('orders.show');

    // Wish List Routes
    Route::get('wish/list', [WishListController::class, 'wishList'])->name('wishlist.index');
    Route::get('wishlist/add-product', [WishListController::class, 'addTowishList'])->name('wishlist.store');
    Route::get('wishlist/remove', [WishListController::class, 'removeFromWishList'])->name('wishlist.remove');

    // Review Routes
    Route::get('reviews', [ReviewController::class, 'index'])->name('review.index');
    Route::post('review', [ReviewController::class, 'create'])->name('review.create');


    // Vendors Request
    Route::post('blog-comment', [PageController::class, 'blogComment'])->name('blog-comment');
 
});

// Home Page Route
Route::get('/', [HomeController::class, 'index'])->name('home.page');

// Admin Login Route
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

// Flash Sale Route
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

// Product Details Routes
Route::get('products', [FrontendProductController::class, 'productIndex'])->name('products.index');
Route::get('product-detail/{slug}', [FrontendProductController::class, 'showProduct'])->name('product-detail');
Route::get('change-product-list-view', [FrontendProductController::class, 'productListView'])->name('change-product-list-view');

// Add to cart routes
Route::post('add-to-cart', [CartController::class, 'addCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('cart/update-quantity', [CartController::class, 'updateProductQuantity'])->name('cart.update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
Route::get('clear/remove-product/{rowId}', [CartController::class, 'clearProduct'])->name('remove.product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
Route::get('cart-products', [CartController::class, 'getCartProduct'])->name('cart-products');
Route::post('cart/remove-sidebar-product', [CartController::class, 'removeSidebarProduct'])->name('cart.remove-sidebar-product');
Route::get('cart/sidebar-product-total', [CartController::class, 'cartTotal'])->name('cart.sidebar-product-total');
Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('coupon-calculation', [CartController::class, 'couponCalculation'])->name('coupon-calculation');

// News Letter route
Route::post('news-letter-request', [NewsLetterController::class, 'newsLetterRequest'])->name('news-letter-request');
Route::get('news-letter-verify/{token}', [NewsLetterController::class, 'newsLetterEmailVerify'])->name('news-letter-verify-email');

// about page route
Route::get('/about', [PageController::class, 'aboutPage'])->name('about.index');

// terms & condition page route
Route::get('/terms-condiiton', [PageController::class, 'termsConditionPage'])->name('terms-condition.index');

// contact route
Route::get('/contact', [PageController::class, 'contactPage'])->name('contact.index');
Route::post('/send-message', [PageController::class, 'sendMessage'])->name('send-message');

// product tract route
Route::get('/product-tracking', [ProductTrackController::class, 'index'])->name('product-track.index');

// blog details
Route::get('/blog-details/{slug}', [PageController::class, 'blogdetailspage'])->name('blog-details');

// blog routes
Route::get('/blog', [PageController::class, 'blog'])->name('blog');


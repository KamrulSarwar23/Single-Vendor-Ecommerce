<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdvertisementController;
use App\Http\Controllers\Backend\FooterGridTwoController;
use App\Http\Controllers\Backend\FooterSocialController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminListController;
use App\Http\Controllers\Backend\AdminProductReviewController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CustomerListControlller;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\FooterGridThreeController;
use App\Http\Controllers\Backend\FooterInfoController;
use App\Http\Controllers\Backend\HomePageSettingController;
use App\Http\Controllers\Backend\ManageUserController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\StripeSettingController;
use App\Http\Controllers\Backend\SubscriberController;
use App\Http\Controllers\Backend\TermsConditionController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\VendorConditionController;
use App\Http\Controllers\Backend\VendorListController;
use App\Http\Controllers\Backend\VendorRequestController;

// Admin profile Routes
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

// Silder Routes
Route::resource('slider', SliderController::class);

// Category Routes
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

// Sub Category Routes
Route::put('subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('subcategory', SubCategoryController::class);

// Sub Category Routes
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-SubCategories');
Route::resource('childcategory', ChildCategoryController::class);

// Brands Routes
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

// Vendor Profile Routes
Route::resource('vendor-profile', AdminVendorProfileController::class);

// Admin Products Routes
Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-sub-categories');
Route::get('product/get-childcategories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('products', ProductController::class);

// Products Image Gallery Routes
Route::resource('product-image-gallery', ProductImageGalleryController::class);

// Products Variants Routes
Route::put('product-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
Route::resource('product-variant', ProductVariantController::class);

// Products Variants Item Routes
Route::get('product-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('product-variant-item.index');
Route::get('product-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('product-variant-item.create');
Route::post('product-variant-item', [ProductVariantItemController::class, 'store'])->name('product-variant-item.store');
Route::get('product-variant-item/edit{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('product-variant-item.edit');
Route::post('product-varian t-item/update{variantItemId}', [ProductVariantItemController::class, 'update'])->name('product-variant-item.update');
Route::delete('product-variant-item/destroy/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('product-variant-item.destroy');
Route::put('product-variant-item/change-status', [ProductVariantItemController::class, 'changeStatus'])->name('product-variant-item.change-status');

// Seller Product
Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products.index');
Route::get('seller-pending-products', [SellerProductController::class, 'pendingProducts'])->name('seller-pending-products.index');
Route::put('change-approve-status', [SellerProductController::class, 'chnageapprovestatus'])->name('change-approve-status');

// Flash Sale
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
Route::put('flash-sale-update', [FlashSaleController::class, 'update'])->name('flash-sale.update');
Route::post('flash-sale-update/add-product', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
Route::put('flash-sale-update/show-at-home/status-change', [FlashSaleController::class, 'changeShowAtHomeStatus'])->name('flash-sale.show-at-home.change-status');
Route::put('flash-sale-item/change-status', [FlashSaleController::class, 'changeStatus'])->name('flash-sale-item.change-status');
Route::delete('flash-sale-item/delete/{id}', [FlashSaleController::class, 'destroy'])->name('flash-sale-item.delete');

// Coupon Routes
Route::put('coupons/change-status', [CouponController::class, 'changeStatus'])->name('coupons.change-status');
Route::resource('coupons', CouponController::class);

// shipping rule Routes
Route::put('shipping-rule/change-status', [ShippingRuleController::class, 'changeStatus'])->name('shipping-rule.change-status');
Route::resource('shipping-rule', ShippingRuleController::class);

// General Setting
Route::get('settings', [SettingController::class, 'index'])->name('setting.index');
Route::put('general-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting-update');

// Paypal Setting Route
Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
Route::resource('paypal-setting', PaypalSettingController::class);

// Stripe Setting
Route::put('stripe-setting/{id}', [StripeSettingController::class, 'update'])->name('stripe-setting.update');

//Email Configuration Setting Routes
Route::put('email-config', [SettingController::class, 'emailConfigSetting'])->name('email-config.update');

//Subscriber Routes
Route::get('subscribers', [SubscriberController::class, 'index'])->name('subscribers');
Route::delete('subscribers-remove/{id}', [SubscriberController::class, 'destory'])->name('remove-subscriber');
Route::post('send-mail-subscribers', [SubscriberController::class, 'sendMail'])->name('send-mail-subscribers');

// Orders Route
Route::get('order-status', [OrderController::class, 'changeOrderStatus'])->name('order.status');
Route::get('payment-status', [OrderController::class, 'changePaymentStatus'])->name('payment.status');
Route::get('pending-order', [OrderController::class, 'pendingOrder'])->name('pending.order');
Route::get('processed_and_ready_to_ship-order', [OrderController::class, 'processedReadyShipOrder'])->name('processed-ready.order');
Route::get('dropped_off-order', [OrderController::class, 'droppedOffOrder'])->name('dropped-off.order');
Route::get('shipped-order', [OrderController::class, 'shippedOrder'])->name('shipped.order');
Route::get('out_for_delivery-order', [OrderController::class, 'outForDeliveryOrder'])->name('outfor-delivery.order');
Route::get('delivered-order', [OrderController::class, 'deliveredOrder'])->name('delivered.order');
Route::get('cancel-order', [OrderController::class, 'cancelOrder'])->name('cancel.order');
Route::resource('order', OrderController::class);

// Orders Transaction route
Route::get('transaction', [TransactionController::class, 'index'])->name('transaction');

// Home Page Routes
Route::get('home-page-setting', [HomePageSettingController::class, 'index'])->name('home-page-setting.index');
Route::put('popular-category-section', [HomePageSettingController::class, 'updatePopularCategorySection'])->name('popular-category-section');
Route::put('product-slider-one', [HomePageSettingController::class, 'productSliderOne'])->name('product-slider-one');
Route::put('product-slider-two', [HomePageSettingController::class, 'productSliderTwo'])->name('product-slider-two');
Route::put('product-slider-three', [HomePageSettingController::class, 'productSliderThree'])->name('product-slider-three');

// Footer info Route
Route::resource('footer-info', FooterInfoController::class);

// Footers social Route
Route::put('footer-social/change-status', [FooterSocialController::class, 'changeStatus'])->name('footer-social.change-status');
Route::resource('footer-social', FooterSocialController::class);

// Footers Grid Two Route
Route::put('footer-grid-two/change-status', [FooterGridTwoController::class, 'changeStatus'])->name('footer-grid-two.change-status');
Route::put('footer-grid-two/change-title', [FooterGridTwoController::class, 'changeTitle'])->name('footer-grid-two.change-title');
Route::resource('footer-grid-two', FooterGridTwoController::class);

// Footers Grid Three Route
Route::put('footer-grid-three/change-status', [FooterGridThreeController::class, 'changeStatus'])->name('footer-grid-three.change-status');
Route::put('footer-grid-three/change-title', [FooterGridThreeController::class, 'changeTitle'])->name('footer-grid-three.change-title');
Route::resource('footer-grid-three', FooterGridThreeController::class);

// Advertisement routes
Route::get('advertisement', [AdvertisementController::class, 'index'])->name('advertisement.index');
Route::put('advertisement/home-page-banner-section-one', [AdvertisementController::class, 'homePageBannerSectionOne'])->name('home-page-banner-section-one');
Route::put('advertisement/home-page-banner-section-two', [AdvertisementController::class, 'homePageBannerSectionTwo'])->name('home-page-banner-section-two');
Route::put('advertisement/home-page-banner-section-three', [AdvertisementController::class, 'homePageBannerSectionThree'])->name('home-page-banner-section-three');
Route::put('advertisement/home-page-banner-section-four', [AdvertisementController::class, 'homePageBannerSectionFour'])->name('home-page-banner-section-four');
Route::put('advertisement/product-page-banner', [AdvertisementController::class, 'productPageBanner'])->name('product-page-banner');
Route::put('advertisement/cart-page-banner', [AdvertisementController::class, 'cartPageBanner'])->name('cart-page-banner');

// Review Routes
Route::put('review-status', [AdminProductReviewController::class, 'changeReviewStatus'])->name('review.status');
Route::get('reviews', [AdminProductReviewController::class, 'index'])->name('review.index');
Route::delete('reviews-remove/{id}', [AdminProductReviewController::class, 'destory'])->name('remove-reviews');

// Vendor Request Routes
Route::get('vendor-status', [VendorRequestController::class, 'changeVendorStatus'])->name('vendor-request.status');
Route::get('vendor-request', [VendorRequestController::class, 'index'])->name('vendor-request.index');
Route::get('vendor-request/{id}/show', [VendorRequestController::class, 'show'])->name('vendor-request.show');

// Vendor List Routes
Route::get('vendor', [VendorListController::class, 'index'])->name('vendor.index');
Route::put('vendor-change-status', [VendorListController::class, 'changeStatus'])->name('vendor.change-status');

// Customer List Routes
Route::get('customers', [CustomerListControlller::class, 'index'])->name('customer.index');
Route::put('customers-change-status', [CustomerListControlller::class, 'changeStatus'])->name('customer.change-status');

// Vendor Condition Routes
Route::get('vendor-condition', [VendorConditionController::class, 'index'])->name('vendor-condition.index');
Route::put('vendor-condition/update', [VendorConditionController::class, 'update'])->name('vendor-condition.update');

// About Page Routes
Route::get('about', [AboutController::class, 'index'])->name('about.index');
Route::put('about/update', [AboutController::class, 'update'])->name('about.update');

// Terms & Conditions Page Routes
Route::get('terms-condition', [TermsConditionController::class, 'index'])->name('terms-condition.index');
Route::put('terms-condition/update', [TermsConditionController::class, 'update'])->name('terms-condition.update');

// Manage User Routes
Route::get('manage-user', [ManageUserController::class, 'index'])->name('manage-user.index');
Route::post('create-user', [ManageUserController::class, 'create'])->name('manage-user.create');

// Customer List Routes
Route::get('admin-list', [AdminListController::class, 'index'])->name('admin-list.index');
Route::put('admin-list-change-status', [AdminListController::class, 'changeStatus'])->name('admin-list.change-status');
Route::delete('admin-destroy/{id}', [AdminListController::class, 'destroy'])->name('admin-list.destroy');

// Blog Category Routes
Route::put('blog-category-change-status', [BlogCategoryController::class, 'changeStatus'])->name('blog-category.change-status');
Route::resource('blog-category', BlogCategoryController::class);

// Blog Routes
Route::put('blog-change-status', [BlogController::class, 'changeStatus'])->name('blog.change-status');
Route::resource('blog', BlogController::class);
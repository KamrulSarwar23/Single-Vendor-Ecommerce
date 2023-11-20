<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ShippingRuleController;

// Admin profile Routes
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

//* Silder Routes*//
Route::resource('slider', SliderController::class);

//* Category Routes*//
Route::put('change-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

//* Sub Category Routes*//
Route::put('subcategory/change-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('subcategory', SubCategoryController::class);

//* Sub Category Routes*//
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-SubCategories');
Route::resource('childcategory', ChildCategoryController::class);

//* Brands Routes*//
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

//* Vendor Profile Routes*//
Route::resource('vendor-profile', AdminVendorProfileController::class);

//* Admin Products Routes*//
Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-sub-categories');
Route::get('product/get-childcategories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('products', ProductController::class);

//* Products Image Gallery Routes*//
Route::resource('product-image-gallery', ProductImageGalleryController::class);

//* Products Variants Routes*//
Route::put('product-variant/change-status', [ProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
Route::resource('product-variant', ProductVariantController::class);

//* Products Variants Item Routes*//
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


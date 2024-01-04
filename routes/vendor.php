<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductReviewController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;

// Vendor Profile Routes
Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

// Vendor Shop Profile Routes
Route::resource('shop-profile', VendorShopProfileController::class);

// Vendor Product Routes
Route::get('product/get-subcategories', [VendorProductController::class, 'getSubCategories'])->name('product.get-sub-categories');
Route::get('product/get-childcategories', [VendorProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::put('product/change-status', [VendorProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('products', VendorProductController::class);

//* Products Image Gallery Routes*//

Route::resource('product-image-gallery', VendorProductImageGalleryController::class);

//* Products Variants Routes*//
Route::put('product-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])->name('product-variant.change-status');
Route::resource('product-variant', VendorProductVariantController::class);

//* Products Variants Item Routes*//
Route::get('product-variant-item/{productId}/{variantId}', [VendorProductVariantItemController::class, 'index'])->name('product-variant-item.index');
Route::get('product-variant-item/create/{productId}/{variantId}', [VendorProductVariantItemController::class, 'create'])->name('product-variant-item.create');
Route::post('product-variant-item', [VendorProductVariantItemController::class, 'store'])->name('product-variant-item.store');
Route::get('product-variant-item/edit{variantItemId}', [VendorProductVariantItemController::class, 'edit'])->name('product-variant-item.edit');
Route::post('product-varian t-item/update{variantItemId}', [VendorProductVariantItemController::class, 'update'])->name('product-variant-item.update');
Route::delete('product-variant-item/destroy/{variantItemId}', [VendorProductVariantItemController::class, 'destroy'])->name('product-variant-item.destroy');
Route::put('product-variant-item/change-status', [VendorProductVariantItemController::class, 'changeStatus'])->name('product-variant-item.change-status');

// Orders route
Route::get('orders', [VendorOrderController::class, 'index'])->name('orders');
Route::get('orders/show/{id}', [VendorOrderController::class, 'show'])->name('orders.show');
Route::post('order-status/{id}', [VendorOrderController::class, 'changeOrderStatus'])->name('order.status');

// Review Routes
Route::get('reviews', [VendorProductReviewController::class, 'index'])->name('review.index');

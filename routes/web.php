<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(\App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
    Route::get('/','index')->name('index');
    Route::get('products','products')->name('frontend.products');
    Route::get('product/{slug}','productShow')->name('frontend.product.show');

    Route::get('product-add-cart','productAddCart')->name('frontend.product.add.cart')
        ->middleware('auth');

    Route::get('orders','orders')->name('frontend.orders');
//    Route::get('carts','carts')->name('frontend.carts');
});

Route::controller(\App\Http\Controllers\Frontend\CartController::class)->middleware('auth')->group(function () {
    Route::get('cart','index')->name('frontend.carts');
    Route::post('add-cart/{id}', 'store')->name('frontend.add-cart');
    Route::post('update-cart', 'update')->name('frontend.update-cart');
    Route::post('remove-cart', 'destroy')->name('frontend.remove-cart');
});

Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::controller(\App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('category', 'index');
        Route::get('category/create', 'create');
        Route::post('category', 'store');
        Route::get('category/edit/{id}', 'edit');
        Route::put('category/{id}', 'update');
        Route::get('category/delete/{id}', 'destroy');
    });

    Route::controller(\App\Http\Controllers\Admin\BrandController::class)->group(function () {
        Route::get('brand', 'index');
        Route::get('brand/create', 'create');
        Route::post('brand', 'store');
        Route::get('brand/edit/{id}', 'edit');
        Route::put('brand/{id}', 'update');
        Route::get('brand/delete/{id}', 'destroy');
    });

    Route::controller(\App\Http\Controllers\Admin\SubCategoryController::class)->group(function () {
        Route::get('subcategory', 'index');
        Route::get('subcategory/create', 'create');
        Route::post('subcategory', 'store');
        Route::get('subcategory/edit/{id}', 'edit');
        Route::put('subcategory/{id}', 'update');
        Route::get('subcategory/delete/{id}', 'destroy');
    });

    Route::controller(\App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('product', 'index');
        Route::get('product/create', 'create');
        Route::post('product', 'store');
        Route::get('product/edit/{id}', 'edit');
        Route::put('product/{id}', 'update');
        Route::get('product/delete/{id}', 'destroy');

        Route::get('product/image/{id}', 'showImage');
        Route::post('product/image/{id}', 'postImage');
        Route::get('product/image/delete/{id}', 'removeImage');
    });

    Route::controller(\App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('slider', 'index');
        Route::get('slider/create', 'create');
        Route::post('slider', 'store');
        Route::get('slider/edit/{id}', 'edit');
        Route::put('slider/{id}', 'update');
        Route::get('slider/delete/{id}', 'destroy');
    });
});

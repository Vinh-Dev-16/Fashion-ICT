<?php

use App\Http\Controllers\user\reviewController;
use App\Http\Controllers\user\cartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\homeController;
use App\Http\Controllers\user\informationController;
use App\Http\Controllers\user\brandController;
use App\Http\Controllers\user\singlePageController;
use App\Http\Controllers\user\wishlistController;
use App\Http\Controllers\user\payPalController;
use App\Http\Controllers\user\categoryController;
use App\Http\Controllers\user\viewAllProductController;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
    Route::prefix('/')->group(function(){
        Route::get('',[homeController::class,'home'])->name('home');
        Route::get('search',[homeController::class,'search'])->name('search');
        Route::get('searchpage',[homeController::class,'searchPage'])->name('searchpage');
        Route::get('shipper',[homeController::class,'shipper'])->middleware('auth')->name('shipper');
        Route::post('shipper/store',[homeController::class,'shipperStore'])->middleware('auth')->name('shipper.store');
        Route::get('pageShip',[homeController::class,'pageShip'])->middleware('auth')->name('pageShip');
        Route::post('shipperSuccess',[homeController::class,'shipperSuccess'])->middleware('auth')->name('shipperSuccess');
        Route::post('confirm',[homeController::class,'confirm'])->middleware('auth')->name('confirm');
        Route::get('confirm/product/{id}',[homeController::class,'confirmProduct'])->middleware('auth')->name('confirmProduct');
        Route::get('pageConfirm',[homeController::class,'pageConfirm'])->middleware('auth')->name('pageConfirm');
        Route::post('confirm/item',[homeController::class,'confirmItem'])->middleware('auth')->name('confirmItem');

        // Route Cart

        Route::post('cart/{id}',[cartController::class,'addToCart'])->name('cart');
        Route::get('removecart/{id}',[cartController::class,'removeCart'])->name('removecart');
        Route::get('viewcart',[cartController::class,'viewCart'])->name('viewcart');
        Route::get('deletecart/{id}',[cartController::class,'deleteCart'])->name('deletecart');
        Route::get('updateQuantity/{id}/{quantity}',[cartController::class,'updateQuantity'])->name('updateQuantity');

        // Cart checkout action

        Route::get('checkout',[cartController::class,'checkout'])->middleware('auth')->name('checkout');
        Route::post('process', [cartController::class, 'process'])->middleware('auth')->name('process');
        Route::get('cancel', [cartController::class, 'cancel'])->middleware('auth')->name('cancel');
        Route::get('success', [cartController::class, 'success'])->middleware('auth')->name('success');


        // Route single-page

        Route::get('/detail/{slug}',[singlePageController::class,'detail'])->name('detail');
        Route::get('pageoffer/{slug}',[singlePageController::class,'pageOffer'])->name('pageoffer');

        //route Category

        Route::prefix('category')->group(function(){
            Route::get('/{slug}',[categoryController::class,'index'])->name('category.index');
            Route::post('list_data', [categoryController::class, 'listData'])->name('category.list_data');
            Route::post('love',[categoryController::class,'love'])->name('category.love');
        });

        // Router Brand
        Route::prefix('brand')->group(function(){
            Route::get('/{slug}',[brandController::class,'index'])->name('brand.index');
            Route::post('list_data', [brandController::class, 'listData'])->name('brand.list_data');
            Route::post('love',[brandController::class,'love'])->name('brand.love');
        });

        // Route viewAllProduct
        Route::prefix('view-all-product')->group(function(){
            Route::get('',[viewAllProductController::class,'index'])->name('view-all-product');
            Route::post('list_data', [viewAllProductController::class, 'listData'])->name('view_all_product.list_data');
        });


//        Route whishlist
        Route::middleware('auth')->prefix('wishlist')->group(function(){
            Route::get('/{id}',[wishlistController::class,'index'])->name('wishlist');
            Route::post('store/{id}',[wishlistController::class,'store'])->name('wishlist.store');
            Route::post('love',[wishlistController::class,'love'])->name('wishlist.love');
            Route::delete('destroy/{id}',[wishlistController::class,'destroy'])->name('wishlist.destroy');
            Route::delete('delete/{id}',[wishlistController::class,'delete'])->name('wishlist.delete');
        });

        // Route infomation user

        Route::middleware('auth')->prefix('information')->group(function(){
            Route::get('/{id}',[informationController::class,'index'])->name('information');
            Route::post('store',[informationController::class,'store'])->name('information.store');
            Route::get('edit/{id}',[informationController::class,'edit'])->name('information.edit');
            Route::patch('update/{id}',[informationController::class,'update'])->name('information.update');
         });

        // Route comment

        Route::middleware('auth')->prefix('/review')->group(function(){
            Route::post('/store/{id}',[reviewController::class,'store'])->name('review.store');
            Route::delete('/destroy/{id}',[reviewController::class,'destroy'])->name('review.destroy');
            Route::get('edit/{id}',[reviewController::class,'edit'])->name('review.edit');
            Route::post('update/{id}',[reviewController::class,'update'])->name('review.update');
        });

        // Route payment
            Route::post('payment', [payPalController::class, 'payment'])->middleware('auth')->name('payment');
            Route::get('payment/voucher/{voucher}',[payPalController::class, 'voucher'])->middleware('auth')->name('payment.voucher');
            Route::get('history',[PayPalController::class, 'history'])->middleware('auth')->name('history');
            Route::post('process-transaction', [payPalController::class, 'processTransaction'])->middleware('auth')->name('processTransaction');
            Route::get('success-transaction', [payPalController::class, 'successTransaction'])->middleware('auth')->name('successTransaction');
            Route::get('cancel-transaction', [payPalController::class, 'cancelTransaction'])->middleware('auth')->name('cancelTransaction');
            Route::get('history', [payPalController::class, 'history'])->middleware('auth')->name('history');
            Route::get('softdelete/{id}', [payPalController::class, 'softdelete'])->middleware('auth')->name('softdelete');
            Route::get('restore/{id}',[payPalController::class, 'restore'])->middleware('auth')->name('restore');
    })

?>

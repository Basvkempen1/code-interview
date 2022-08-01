<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LivewireController;
use App\Http\Controllers\ProductController;
use App\Http\Livewire\Product\PriceMutations;
use App\Http\Livewire\Product\Prices;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('index');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('', [ProductController::class, 'index'])
            ->name('index');
/* Commented for later use */
//        Route::get('{productId?}', [ProductController::class, 'show'])
//            ->name('products.show');
        Route::get('{product}/price-mutations/external', PriceMutations::class)
            ->name('price-mutations.external');
    });

    Route::prefix('marketing')->group(function () {
        Route::name('marketing.')->group(function () {
            Route::resource('banners', BannerController::class);

        });
    });
});

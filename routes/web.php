<?php

use App\Models\product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\citiesController;
use App\Http\Controllers\colorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\productController;
use App\Http\Controllers\regionsController;
use App\Http\Controllers\sizeController;
use App\Http\Controllers\shippingController;

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

Route::get('/' ,[productController::class,'home']);
Route::get('categories',[categoriesController::class, 'navIndex']);

Route::middleware('auth')->group(function(){
    //===AUTH===
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('is_admin')->group(function(){
        //Category
        Route::get('category',[categoriesController::class,'index'])->name('category.index');
        Route::get('createCategory',[categoriesController::class,'create'])->name('category.create');
        Route::post('Category',[categoriesController::class,'store'])->name('category.store');
        Route::delete('Category/{id}',[categoriesController::class,'delete'])->name('category.destroy');
        Route::get('Category/{id}',[categoriesController::class,'edit'])->name('category.edit');
        Route::put('Category',[categoriesController::class,'update'])->name('category.update');

        //products
        Route::get('create',[productController::class,'create'])->name('products.create');
        Route::post('store',[productController::class,'store']);
        Route::get('show/{id}',[productController::class,'show'])->name('products.show');
        // Route::get('products',[AdminController::class,'allProducts']);
        Route::get('/productsAll',[productController::class,'allProducts'])->name('products.all');
        Route::delete('deleteProduct/{id}',[productController::class,'delete'])->name('products.delete');
        Route::get('editProduct/{id}',[productController::class,'edit'])->name('products.edit');
        Route::PUT('updateProduct/{id}',[productController::class,'update'])->name('products.update');
        Route::get('/products/{id}/updateStatus', [ProductController::class, 'updateBestSelling'])->name('updateBestSelling.update');
        Route::get('adminProfile',[productController::class,'allProducts']);

        Route::get('curnncy',[AdminController::class,'curnncy']);
        Route::get('editCurrncy/{id}',[AdminController::class,'editCurrncy']);
        Route::PUT('updateCurnncy/{id}',[AdminController::class,'updateCurnncy']);

        //color
        Route::get('colorIndex',[colorController::class,'index'])->name('color.index');
        Route::get('color',[colorController::class,'create'])->name('color.create');
        Route::post('color',[colorController::class,'store'])->name('color.store');
        Route::get('color/{id}',[colorController::class,'edit'])->name('color.edit');
        Route::put('color',[colorController::class,'update'])->name('color.update');
        Route::delete('color/{id}',[colorController::class,'delete'])->name('color.destroy');
        
        //size
        Route::get('sizeIndex',[sizeController::class,'index'])->name('size.index');
        Route::get('size',[sizeController::class,'create'])->name('size.create');
        Route::post('size',[sizeController::class,'store'])->name('size.store');
        Route::get('size/{id}',[sizeController::class,'edit'])->name('size.edit');
        Route::put('size',[sizeController::class,'update'])->name('size.update');
        Route::delete('size/{id}',[sizeController::class,'delete'])->name('size.destroy');

        //BestSelling
        // Route::get('updateBestSelling/{id}',[productController::class,'updateBestSelling'])->name('updateBestSelling.update');

        Route::get('city',[citiesController::class,'index'])->name('city.index');
        Route::get('createCity',[citiesController::class,'create'])->name('city.create');
        Route::post('city',[citiesController::class,'store'])->name('city.store');
        Route::delete('City/{id}',[citiesController::class,'delete'])->name('city.destroy');
        Route::get('city/{id}',[citiesController::class,'edit'])->name('city.edit');
        Route::put('city',[citiesController::class,'update'])->name('city.update');

        // Route::get('region',[regionsController::class,'index'])->name('region.index');
        // Route::get('createRegion',[regionsController::class,'create'])->name('region.create');
        // Route::post('region',[regionsController::class,'store'])->name('region.store');
        // Route::delete('region/{id}',[regionsController::class,'delete'])->name('region.destroy');
        // Route::get('region/{id}',[regionsController::class,'edit'])->name('region.edit');
        // Route::put('region',[regionsController::class,'update'])->name('region.update');


        // routes/web.php
        
        Route::get('shipping',[shippingController::class,'index'])->name('shipping.index');
        Route::get('/shipping/create',[shippingController::class,'create'])->name('shipping.create');
        Route::post('/shipping/store',[shippingController::class,'store'])->name('shipping.store');
        Route::delete('/shipping/delete/{id}',[shippingController::class,'delete'])->name('shipping.destroy');
        Route::get('/shipping/edit/{id}',[shippingController::class,'edit'])->name('shipping.edit');
        Route::put('/shipping/update',[shippingController::class,'update'])->name('shipping.update');
    });

    //orders
    // Route::get('orders',[AdminController::class,'orders']);
   

    //Admin order
    Route::get('adminOrders',[OrderController::class,'adminOrders'])->middleware('is_admin');
    Route::get('viewOrder/{id}',[OrderController::class,'viewOrder'])->middleware('is_admin');
    Route::put('updateStatus/{id}',[OrderController::class,'updateStatus'])->name('updateOrderStatus')->middleware('is_admin');
    Route::get('pendingOrder',[AdminController::class,'pendingOrder'])->middleware('is_admin');
    Route::get('deliveredOrder',[AdminController::class,'deliveredOrder'])->middleware('is_admin');

    
    //order
    // Route::get('order',[AdminController::class,'order']);
    //edit order
    Route::get('editOrder/{id}',[AdminController::class,'editOrder']);
    Route::put('updateOrder/{id}',[AdminController::class,'updateOrder']);
    Route::get('deleteOrder/{id}',[AdminController::class,'deleteOrder']);


    Route::get('sales',[AdminController::class,'sales']);


    //search
    Route::get('search',[AdminController::class,'search']);
});


Route::get('/getRegions/{cityId}',[shippingController::class,'getRegions'])->name('getRegions');
Route::get('/getRegionsShipping/{cityId}',[shippingController::class,'getRegionsShipping'])->name('getRegionsShipping');
Route::get('/getShippingPrice/{cityId}', [ShippingController::class, 'getShippingPrice'])->name('getShippingPrice');


Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'registerForm'])->name('registerForm');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::get('login', [AuthController::class, 'loginForm'])->name('loginForm');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::get('chechkOut',[OrderController::class,'chechkOut']);
Route::get('orders',[OrderController::class,'placeUserOrder']);
Route::post('order',[OrderController::class,'order']);

//===USER.PRODUCTS===
Route::get('userProducts',[productController::class,'userAllProducts'])->name('allProducts');
Route::get('category/{id}',[productController::class,'categoryFilter']);
Route::get('productDetails/{id}',[productController::class,'productDetail'])->name('productDetail');
Route::get('bestSelling',[productController::class,'allBestSelling']);


//===CART===
Route::post('cart',[cartController::class,'addToCart'])->name('cart.store');
Route::get('cartList',[cartController::class,'cartList'])->name('cartList');
Route::get('removeCart/{id}',[cartController::class,'removeCart']);


//===APP.SETTINGS===
Route::get('appSettingsIndex',[AppSettingsController::class,'index'])->name('appSettings.index');
Route::get('appSettings',[AppSettingsController::class,'create'])->name('appSettings.create');
Route::post('appSettings',[AppSettingsController::class,'store'])->name('appSettings.store');
Route::get('appSettingShow/{id}',[AppSettingsController::class,'show'])->name('appSettings.show');
Route::get('appSettings/{id}',[AppSettingsController::class,'edit'])->name('appSettings.edit');
Route::put('appSettings/{id}',[AppSettingsController::class,'update'])->name('appSettings.update');
Route::delete('appSettings/{id}',[AppSettingsController::class,'delete'])->name('appSettings.delete');
Route::get('footer', [AppSettingsController::class,'footerData'])->name('appSettings.footer');
Route::get('ReturnPolicy',[AppSettingsController::class,'ReturnPolicy'])->name('appSettings.ReturnPolicy');
Route::get('shippingPolicy',[AppSettingsController::class,'shippingPolicy'])->name('appSettings.shippingPolicy');

//categories
// Route::get('skirt',[AdminController::class,'skirt']);
// Route::get('dress',[AdminController::class,'dress']);
// Route::get('swimmingWear',[AdminController::class,'swimmingWear']);
// Route::get('blouses',[AdminController::class,'blouses']);

// Route::get('sets',[AdminController::class,'sets']);
// Route::get('cardigan',[AdminController::class,'cardigan']);
// Route::get('abaya',[AdminController::class,'abaya']);
// Route::get('basic',[AdminController::class,'basic']);
// Route::get('bags',[AdminController::class,'bags']);
// Route::get('tunic',[AdminController::class,'tunic']);
// Route::get('scarfs',[AdminController::class,'scarfs']);
// Route::get('kimono',[AdminController::class,'kimono']);
// Route::get('shaan',[AdminController::class,'shaan']);
// Route::get('ergaa',[AdminController::class,'ergaa']);


// //currency
// Route::get('convertCurrnecy',[AdminController::class,'convertCurrnecy']);
// Route::get('convertCurrnecyDet/{id}',[AdminController::class,'convertCurrnecyDet']);
// Route::get('convertCurrnecyCart',[AdminController::class,'convertCurrnecyCart']);
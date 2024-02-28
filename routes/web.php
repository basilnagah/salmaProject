<?php

use App\Models\product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

Route::get('/' ,[AdminController::class,'home']);




Route::middleware('guest')->group(function () {


    Route::get('register', [AuthController::class, 'registerForm'])->name('registerForm');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::get('login', [AuthController::class, 'loginForm'])->name('loginForm');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');





Route::get('adminProfile',[AdminController::class,'allProducts']);





//create
Route::get('create',[AdminController::class,'create']);
Route::post('store',[AdminController::class,'store']);

//all
Route::get('products',[AdminController::class,'allProducts']);

//delete
Route::delete('deleteProduct/{id}',[AdminController::class,'delete']);

//edit
Route::get('editProduct/{id}',[AdminController::class,'edit']);
Route::PUT('updateProduct/{id}',[AdminController::class,'update']);

//curnncy
Route::get('curnncy',[AdminController::class,'curnncy']);
Route::get('editCurrncy/{id}',[AdminController::class,'editCurrncy']);
Route::PUT('updateCurnncy/{id}',[AdminController::class,'updateCurnncy']);











//userallproducrs
Route::get('userProducts',[AdminController::class,'userAllProducts']);


//productDetails
Route::get('productDetails/{id}',[AdminController::class,'productDetail']);



//add to cart
Route::post('addToCart/{id}',[AdminController::class,'addToCart']);

//cart list
Route::get('cartList',[AdminController::class,'cartList']);
Route::get('cartList',[AdminController::class,'cartList']);


//remove cart
Route::get('removeCart/{id}',[AdminController::class,'removeCart']);






//categories
Route::get('skirt',[AdminController::class,'skirt']);
Route::get('dress',[AdminController::class,'dress']);
Route::get('swimmingWear',[AdminController::class,'swimmingWear']);
Route::get('blouses',[AdminController::class,'blouses']);
Route::get('sales',[AdminController::class,'sales']);
Route::get('orders',[AdminController::class,'orders']);
Route::get('sets',[AdminController::class,'sets']);
Route::get('cardigan',[AdminController::class,'cardigan']);
Route::get('abaya',[AdminController::class,'abaya']);
Route::get('basic',[AdminController::class,'basic']);
Route::get('bags',[AdminController::class,'bags']);
Route::get('tunic',[AdminController::class,'tunic']);
Route::get('scarfs',[AdminController::class,'scarfs']);
Route::get('kimono',[AdminController::class,'kimono']);
Route::get('deleteOrder/{id}',[AdminController::class,'deleteOrder']);
Route::get('ergaa',[AdminController::class,'ergaa']);
Route::get('shaan',[AdminController::class,'shaan']);
// Route::get('ergaa',[AdminController::class,'ergaa']);







//checkout
Route::get('chechkOut',[AdminController::class,'chechkOut']);


//order
Route::get('order',[AdminController::class,'order']);





//Admin order
Route::get('adminOrders',[AdminController::class,'adminOrders']);

//edit order
Route::get('editOrder/{id}',[AdminController::class,'editOrder']);
Route::put('updateOrder/{id}',[AdminController::class,'updateOrder']);


//view order
Route::get('viewOrder/{id}',[AdminController::class,'viewOrder']);
Route::get('pendingOrder',[AdminController::class,'pendingOrder']);
Route::get('deliveredOrder',[AdminController::class,'deliveredOrder']);



//currency
Route::get('convertCurrnecy',[AdminController::class,'convertCurrnecy']);
Route::get('convertCurrnecyDet/{id}',[AdminController::class,'convertCurrnecyDet']);
Route::get('convertCurrnecyCart',[AdminController::class,'convertCurrnecyCart']);




//search
Route::get('search',[AdminController::class,'search']);

<?php

use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductScentController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\CustomerInformationController;
use App\Http\Controllers\ShippingMethodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//pulic route
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register/validate', [AuthController::class, 'checkValidRegister']);
//category
Route::get('/productcategories', [ProductCategoryController::class, 'index']);
Route::get('/productcategories/{id}', [ProductCategoryController::class, 'show']);
//product
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/categories/{id}', [ProductController::class, 'categorize']);
//product scent
Route::get('/productscents', [ProductScentController::class, 'index']);
Route::get('/productscents/{id}', [ProductScentController::class, 'show']);
Route::get('/productscents/products/{id}', [ProductScentController::class, 'getAllScentFromProduct']);
//product size
Route::get('/productsizes', [ProductSizeController::class, 'index']);
Route::get('/productsizes/{id}', [ProductSizeController::class, 'show']);
Route::get('/productsizes/scents/{id}', [ProductSizeController::class, 'getAllSizeFromScent']);
//cart
Route::get('/carts', [CartController::class, 'index']);
Route::get('/carts/{id}', [CartController::class, 'show']);
Route::get('/carts/incart/{id}', [CartController::class, 'getCurrentCart']);
//discount
Route::get('/discounts', [DiscountController::class, 'index']);
Route::get('/discounts/{id}', [DiscountController::class, 'show']);
Route::get('/discounts/search/{code}', [DiscountController::class, 'search']);
//customer information
Route::get('/customerinformation', [CustomerInformationController::class, 'index']);
Route::get('/customerinformation/{id}', [CustomerInformationController::class, 'show']);
//shipping method
Route::get('/shippingmethods', [ShippingMethodController::class, 'index']);
Route::get('/shippingmethods/{id}', [ShippingMethodController::class, 'show']);
//order
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
//order detail
Route::get('/orderdetails', [OrderDetailController::class, 'index']);
Route::get('/orderdetails/{id}', [OrderDetailController::class, 'show']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    //admin protect route
    Route::post('/productcategories', [ProductCategoryController::class, 'store'])->middleware('restrictRole:admin');
    Route::put('/productcategories/{id}', [ProductCategoryController::class, 'update'])->middleware('restrictRole:admin');
    Route::delete('/productcategories/{id}', [ProductCategoryController::class, 'destroy'])->middleware('restrictRole:admin');

    Route::post('/products', [ProductController::class, 'store'])->middleware('restrictRole:admin');
    Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('restrictRole:admin');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('restrictRole:admin');

    Route::post('/productscents', [ProductScentController::class, 'store'])->middleware('restrictRole:admin');
    Route::put('/productscents/{id}', [ProductScentController::class, 'update'])->middleware('restrictRole:admin');
    Route::delete('/productscents/{id}', [ProductScentController::class, 'destroy'])->middleware('restrictRole:admin');

    Route::post('/productsizes', [ProductSizeController::class, 'store'])->middleware('restrictRole:admin');
    Route::put('/productsizes/{id}', [ProductSizeController::class, 'update']);
    Route::delete('/productsizes/{id}', [ProductSizeController::class, 'destroy'])->middleware('restrictRole:admin');

    Route::post('/discounts', [DiscountController::class, 'store'])->middleware('restrictRole:admin');
    Route::put('/discounts/{id}', [DiscountController::class, 'update'])->middleware('restrictRole:admin');
    Route::delete('/discounts/{id}', [DiscountController::class, 'destroy'])->middleware('restrictRole:admin');

    Route::post('/shippingmethods', [ShippingMethodController::class, 'store'])->middleware('restrictRole:admin');
    Route::put('/shippingmethods/{id}', [ShippingMethodController::class, 'update'])->middleware('restrictRole:admin');
    Route::delete('/shippingmethods/{id}', [ShippingMethodController::class, 'destroy'])->middleware('restrictRole:admin');

    //all user protected route
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/carts', [CartController::class, 'store']);
    Route::put('/carts/{id}', [CartController::class, 'update']);
    Route::delete('/carts/{id}', [CartController::class, 'destroy']);
    Route::post('/carts/checkout/{id}', [CartController::class, 'checkout']);
    Route::put('/carts/checkout/{id}', [CartController::class, 'checkoutAgain']);
    Route::post('/carts/pay/{id}', [CartController::class, 'pay']);
    Route::get('/carts/notification/{id}', [CartController::class, 'notification']);

    Route::post('/customerinformation', [CustomerInformationController::class, 'store']);
    Route::put('/customerinformation/{id}', [CustomerInformationController::class, 'update']);
    Route::delete('/customerinformation/{id}', [CustomerInformationController::class, 'destroy']);

    Route::post('/orders', [OrderController::class, 'store']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
    Route::get('/orders/unpaid/{id}', [OrderController::class, 'getUnpaidOrder']);
    Route::get('/orders/discounts/{id}', [OrderController::class, 'discount']);
    Route::get('/orders/customerinformation/{id}', [OrderController::class, 'customerInformation']);
    Route::get('/orders/shippingmethods/{id}', [OrderController::class, 'shippingMethod']);
    Route::get('/orders/confirm/{id}', [OrderController::class, 'getOrder']);

    Route::post('/orderdetails', [OrderDetailController::class, 'store']);
    Route::put('/orderdetails/{id}', [OrderDetailController::class, 'update']);
    Route::delete('/orderdetails/{id}', [OrderDetailController::class, 'destroy']);
    Route::get('/orderdetails/orders/{id}', [OrderDetailController::class, 'getOrderDetailByOrder']);
});

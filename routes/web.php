<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('login');
Route::get('/admin/register/', [\App\Http\Controllers\AdminController::class, 'register'])->name('register');
Route::get('/resetPasswordView/', [\App\Http\Controllers\MailController::class, 'resetPasswordView'])->name('resetPassView');
Route::get('/resetPassword/', [\App\Http\Controllers\MailController::class, 'resetPassword'])->name('resetPass');
Route::get('/resetMail/', [\App\Http\Controllers\MailController::class, 'resetMail'])->name('resetMail');
Route::get('/changePasswordView/', [\App\Http\Controllers\MailController::class, 'changePasswordView'])->name('changePasswordView');
Route::post('/changePassword/', [\App\Http\Controllers\MailController::class, 'changePassword'])->name('changePassword');





Route::post('/admin/register', [\App\Http\Controllers\AdminController::class, 'store'])->name('createAdmin');
Route::post('/admin/', [\App\Http\Controllers\AdminController::class, 'login'])->name('adminLogin');
Route::get('/admin/dashboard/', [\App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/admin/profile/', [\App\Http\Controllers\HomeController::class, 'profile'])->name('AdminProfile');
Route::get('admin/productList/', [\App\Http\Controllers\HomeController::class, 'productList'])->name('productsList');
Route::get('admin/placeOrder/', [\App\Http\Controllers\HomeController::class, 'placeOrder'])->name('placeOrder');
Route::get('admin/addProduct/', [\App\Http\Controllers\HomeController::class, 'addProduct'])->name('addProduct');
Route::get('admin/updateProduct/', [\App\Http\Controllers\HomeController::class, 'updateProduct'])->name('updateProduct');
Route::get('/admin/invoice/', [\App\Http\Controllers\CartController::class, 'invoice'])->name('invoice');





Route::get('/search/', [\App\Http\Controllers\HomeController::class, 'search'])->name('searchproduct');
Route::get('/updateSearch/', [\App\Http\Controllers\ProductController::class, 'updateSearch'])->name('updateSearch');
Route::get('/cartSearchBlock/', [\App\Http\Controllers\ProductController::class, 'cartSearchBlock'])->name('cartSearchBlock');
Route::get('/enableProduct/', [\App\Http\Controllers\ProductController::class, 'enableProduct'])->name('enableProduct');
Route::get('/setSessionLight/', [\App\Http\Controllers\HomeController::class, 'setSessionLight'])->name('setSessionLight');
Route::get('/getSession/', [\App\Http\Controllers\HomeController::class, 'getSession'])->name('getSession');
Route::get('/addToCart/', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
Route::get('/showCart/', [\App\Http\Controllers\CartController::class, 'showCart'])->name('showCart');
Route::get('/removeFromCart/', [\App\Http\Controllers\CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::get('/clearCart/', [\App\Http\Controllers\CartController::class, 'clearCart'])->name('clearCart');
Route::get('/updateCartQuantity/', [\App\Http\Controllers\CartController::class, 'updateCartQuantity'])->name('updateCartQuantity');
Route::get('/replaceCartQuantity/', [\App\Http\Controllers\CartController::class, 'replaceCartQuantity'])->name('replaceCartQuantity');
Route::get('/getCartTotal/', [\App\Http\Controllers\CartController::class, 'getCartTotal'])->name('getCartTotal');
Route::get('/getSubTotal/', [\App\Http\Controllers\CartController::class, 'getSubTotal'])->name('getSubTotal');
Route::get('/cartDiscount/', [\App\Http\Controllers\CartController::class, 'cartDiscount'])->name('cartDiscount');
Route::get('/clearCartCondition/', [\App\Http\Controllers\CartController::class, 'clearCartCondition'])->name('clearCartCondition');
Route::get('/checkout/', [\App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
Route::get('/initiateCartClearance/', [\App\Http\Controllers\CartController::class, 'initiateCartClearance'])->name('initiateCartClearance');
Route::get('/initiateCartClearance/', [\App\Http\Controllers\CartController::class, 'initiateCartClearance'])->name('initiateCartClearance');
Route::get('/admin/generateInv/', [\App\Http\Controllers\CartController::class, 'generateInv'])->name('generateInv');
Route::get('/admin/updateInv/', [\App\Http\Controllers\CartController::class, 'updateInv'])->name('updateInv');











Route::post('/admin/addProduct/', [\App\Http\Controllers\ProductController::class, 'store'])->name('storeProduct');
Route::post('/admin/editProduct/', [\App\Http\Controllers\ProductController::class, 'edit'])->name('editProduct');
Route::get('/admin/batchUpdate/', [\App\Http\Controllers\ProductController::class, 'batchUpdate'])->name('batchUpdate');
Route::post('/admin/addCategory/', [\App\Http\Controllers\ProductController::class, 'addCategory'])->name('addCategory');
Route::get('/admin/generateStatement/', [\App\Http\Controllers\ProductController::class, 'generateStatement'])->name('generateStatement');
Route::get('/admin/generateSalesAndStock/', [\App\Http\Controllers\ProductController::class, 'generateSalesAndStock'])->name('generateSalesAndStock');
Route::get('/admin/statementView/', [\App\Http\Controllers\ProductController::class, 'statementView'])->name('statementView');
Route::get('/admin/ssView/', [\App\Http\Controllers\ProductController::class, 'ssView'])->name('ssView');









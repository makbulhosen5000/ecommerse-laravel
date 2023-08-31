<?php

use App\Http\Controllers\HomesController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomesController::class, 'index']);
Route::prefix('todos')->controller(HomesController::class)->name('todos.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('show/{slug}', ['show'])->name('show');
    Route::get('edit/{slug}', ['edit'])->name('edit');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/redirect', [HomesController::class, 'redirect'])->middleware('auth', 'verified');
//.... product_details routes frontend ....//
Route::get('/product_details/{id}', [HomesController::class, 'productDetails']);
Route::post('/add_cart/{id}', [HomesController::class, 'AddCart']);
Route::get('/show_cart', [HomesController::class, 'showCart']);
Route::get('/remove_cart/{id}', [HomesController::class, 'removeCart']);
Route::get('/cash_on_delivery', [HomesController::class, 'cashOnDelivery']);
Route::get('/stripe/{totalPrice}', [HomesController::class, 'stripe']);
Route::post('/stripe/{totalPrice}', [HomesController::class, 'stripePost'])->name('stripe.post');

//.... category routes  ....//
Route::get('/view_category', [AdminController::class, 'viewCategory']);
Route::post('/add_category', [AdminController::class, 'addCategory']);
Route::get('/delete_category/{id}', [AdminController::class, 'deleteCategory']);

//.... product routes for backend ....//
Route::get('/view_product', [AdminController::class, 'viewProduct']);
Route::post('/add_product', [AdminController::class, 'addProduct']);
Route::get('/show_product', [AdminController::class, 'showProduct']);
Route::get('/update_product/{id}', [AdminController::class, 'updateProduct']);
Route::post('/update_product_store/{id}', [AdminController::class, 'updateProductStore']);
Route::get('/delete_product/{id}', [AdminController::class, 'deleteProduct']);
Route::get('/order', [AdminController::class, 'order']);
Route::get('/delivered/{id}', [AdminController::class, 'delivered']);
Route::get('/print_pdf/{id}', [AdminController::class, 'printPdf']);
Route::get('/send_email/{id}', [AdminController::class, 'sendEmail']);
Route::post('/send_user_email/{id}', [AdminController::class, 'sendUserEmail']);

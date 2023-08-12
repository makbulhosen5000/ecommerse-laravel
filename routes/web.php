<?php

use App\Http\Controllers\HomesController;
use App\Http\Controllers\admin\AdminController;
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
});
Route::get('/',[HomesController::class,'index']);
Route::prefix('todos')->controller(HomesController::class)->name('todos.')->group(function () {   
     Route::get('','index')->name('index');
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
Route::get('/redirect',[HomesController::class, 'redirect']);
Route::get('/view_category',[AdminController::class, 'viewCategory']);
Route::post('/add_category', [AdminController::class, 'addCategory']);


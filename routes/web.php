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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

//Route::get('/groups', [App\Http\Controllers\GroupController::class, 'index'])->name('groups');
//Route::post('/goups/update-order', [App\Http\Controllers\GroupController::class, 'updateOrder'])->name('groups');
//Route::get('/groups/update-order', [App\Http\Controllers\GroupController::class, 'updateOrder'])->name('groups');

//cutting
Route::get('/cuttings', [App\Http\Controllers\CuttingController::class, 'index'])->name('cuttings');


//schedule
Route::get('/schedules', [App\Http\Controllers\ScheduleController::class, 'index'])->name('schedules');
Route::post('/schedules/store',[App\Http\Controllers\ScheduleController::class, 'store'])->name('schedule.store');
Route::post('/schedules/update',[App\Http\Controllers\ScheduleController::class, 'update'])->name('schedule.update');
//Route::get('/schedules/print_pdf', [App\Http\Controllers\ScheduleController::class, 'print_pdf'])->name('schedule.print_pdf');


//storage
Route::get('/storages', [App\Http\Controllers\StorageController::class, 'index'])->name('storages');

//product
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
Route::post('/products/update',[App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
Route::post('/products/store',[App\Http\Controllers\ProductController::class, 'store'])->name('product.store');


//order
Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders');
Route::post('/orders/update',[App\Http\Controllers\OrderController::class, 'update'])->name('order.update');
Route::post('/orders/store',[App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
Route::get('/orders/req',[App\Http\Controllers\OrderController::class, 'req'])->name('order.req');
Route::get('/orders/destroy',[App\Http\Controllers\OrderController::class, 'destroy'])->name('order.destroy');

//kanban status
Route::get('/kanbans', [App\Http\Controllers\KanbanController::class, 'index'])->name('kanbans');

    










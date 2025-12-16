<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::resource('employees', EmployeeController::class);


use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WorkTimeController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/item', [App\Http\Controllers\ItemController::class, 'create']);
Route::post('/item',[App\Http\Controllers\ItemController::class, 'store']);

// 商品関連
Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');
Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

// レビュー関連
Route::get('/items/{item}/reviews', [ReviewController::class, 'index'])->name('items.reviews.index');
Route::post('/items/{item}/reviews', [ReviewController::class, 'store'])->name('items.reviews.store');
Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');

//　出退勤関連
Route::get('/work-times', [WorkTimeController::class, 'index']);
Route::get('/work-times', [WorkTimeController::class, 'index'])->name('work.index');
Route::post('/work-times/start', [WorkTimeController::class, 'start'])->name('work.start');
Route::post('/work-times/end', [WorkTimeController::class, 'end'])->name('work.end');
Route::post('/work-times/rest-on', [WorkTimeController::class, 'restOn'])->name('work.rest_on');
Route::post('/work-times/rest-back', [WorkTimeController::class, 'restBack'])->name('work.rest_back');

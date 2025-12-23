<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
// use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WorkTimeController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// ユーザー
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// 商品関連
Route::get('/item', [ItemController::class, 'create']);
Route::post('/item', [ItemController::class, 'store']);

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



// 出退勤登録関連
Route::get('/attendances/create', [AttendanceController::class, 'create'])->name('attendances.create');
Route::post('/attendances/clock-in', [AttendanceController::class, 'clockIn'])->name('attendances.clockIn');
Route::post('/attendances/break-start', [AttendanceController::class, 'breakStart'])->name('attendances.breakStart');
Route::post('/attendances/break-end', [AttendanceController::class, 'breakEnd'])->name('attendances.breakEnd');
Route::post('/attendances/clock-out', [AttendanceController::class, 'clockOut'])->name('attendances.clockOut');

// 出退勤編集関連
Route::get('/attendances/{attendance}/edit', [AttendanceController::class, 'edit'])->name('attendances.edit');
Route::put('/attendances/{attendance}', [AttendanceController::class, 'update'])->name('attendances.update');


// 出退勤一覧関連
Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');

// ルートの一覧を表示するページ（開発が終わったら消します）
use App\Http\Controllers\RouteListController;

Route::get('/route-list', [RouteListController::class, 'index'])->name('route.list');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

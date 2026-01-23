<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

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

// お問い合わせフォーム
Route::get('/', [ContactController::class, 'index'])->name('index');
Route::post('confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('store', [ContactController::class, 'store'])->name('store');
Route::get('thanks', [ContactController::class, 'thanks'])->name('thanks');

// 管理画面
Route::middleware('auth')->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin');
    Route::get('detail/{id}', [AdminController::class, 'detail'])->name('detail');
    Route::get('delete', [AdminController::class, 'delete'])->name('delete');
    Route::get('export', [AdminController::class, 'export'])->name('export');
});

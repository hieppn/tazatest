<?php

use App\Events\Message;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('categories', [CategoryController::class, 'getAllCategories'])->name('categories.getAllCategories');
Route::get('categories/{id}', [CategoryController::class, 'getCategory'])->name('categories.getCategory');
Route::post('categories', [CategoryController::class, 'create'])->name('categories.create');
Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

Route::get('products', [ProductController::class, 'getAllProducts'])->name('products.getAllProducts');
Route::get('products/{id}', [ProductController::class, 'getProduct'])->name('products.getProduct');
Route::post('products', [ProductController::class, 'create'])->name('products.create');
Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products/{id}', [ProductController::class, 'delete'])->name('products.delete');

Route::post('/send-message',[MessageController::class, 'chat'])->name('messages.chat');
Route::post('groups',[GroupController::class, 'store'])->name('groups.store');
Route::post('groups/join',[GroupController::class, 'join'])->name('groups.join');
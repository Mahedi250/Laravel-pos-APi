<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Modules\Category\Http\Controllers\CategoryController;

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

// Route::middleware('auth:api')->get('/category', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::post('/all', [CategoryController::class, 'index'])->name('all');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});
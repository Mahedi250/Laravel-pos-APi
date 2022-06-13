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

Route::group(['prefix' => 'category', 'as' => 'category.', 'middleware' => ['auth:sanctum']], function () {
    Route::get('/parent', [CategoryController::class, 'index'])->name('all');
    Route::get('/child/{parent_id}', [CategoryController::class, 'getchild'])->name('all');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::post('/ ', [CategoryController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\User\Http\Controllers\UserAuthController;
use Modules\User\Http\Controllers\RegisterController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('register', [RegisterController::class, 'register'])
    ->middleware('restrictothers');

Route::get('/loginfirst', function () {
    return response()->json(["mesage" => "Please login first"], 403);
})->name('loginfirst');



Route::post('/login', [UserAuthController::class, 'login'])->name('login');




Route::middleware('auth:sanctum')->get('/hello', function () {
    return response()->json([['test' => "this my first api"], ['test' => "this my first api"]]);
});

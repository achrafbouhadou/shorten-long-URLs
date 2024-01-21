<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;


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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/urls', [ShortUrlController::class, 'index']);
    Route::post('/urls', [ShortUrlController::class, 'store']);
    Route::get('/urls/{id}', [ShortUrlController::class, 'show']);
    Route::put('/urls/{id}', [ShortUrlController::class, 'update']);
    Route::delete('/urls/{id}', [ShortUrlController::class, 'destroy']);
});

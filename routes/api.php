<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::apiResource('/news', NewsController::class);
Route::apiResource('news.images', NewsImageController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/check_token', [AuthController::class, 'checkToken']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


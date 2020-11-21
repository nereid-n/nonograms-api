<?php

use App\Http\Controllers\Api\NonogramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;

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

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);
Route::post('logout', LogoutController::class)->middleware('auth:api');
Route::post('nonograms/add', [NonogramController::class, 'add'])->middleware('auth:api');
Route::get('nonograms', [NonogramController::class, 'index'])->middleware('auth:api');
Route::get('nonograms/{id}', [NonogramController::class, 'get'])->middleware('auth:api');
Route::delete('nonograms/{id}', [NonogramController::class, 'delete'])->middleware('auth:api');

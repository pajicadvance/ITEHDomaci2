<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);

Route::get('/users/{id}', [UserController::class, 'show']);

Route::get('/users/{id}/gpus', [UserController::class, 'showAllGpus']);

Route::get('/gpus/{id}', [GPUController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::delete('/gpus/{id}/delete', [GPUController::class, 'destroy']);

    Route::post('/gpus/create', [GPUController::class, 'create']);

    Route::put('/gpus/{id}/edit', [GPUController::class, 'edit']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
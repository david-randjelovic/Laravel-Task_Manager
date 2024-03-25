<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ListController;
use App\Http\Controllers\Api\TaskController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group( function () {

    Route::get('/lists', [ListController::class, 'index']);
    Route::post('/lists', [ListController::class, 'store']);
    Route::patch('/lists/{list}', [ListController::class, 'update']);
    Route::delete('/lists/{list}', [ListController::class, 'destroy']);

    Route::patch('/tasks/{task}', [TaskController::class, 'updateList']);
    Route::patch('/task/{task}', [TaskController::class, 'update']);
    Route::post('/tasks', [TaskController::class, 'store']);  
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
});

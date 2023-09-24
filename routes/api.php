<?php

use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TasksController;
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


// Model User
Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);
Route::get('/user/get', [UserController::class, 'get']);

// Model Project
Route::post('/project/create', [ProjectsController::class, 'store']);
Route::get('/project/show', [ProjectsController::class, 'show']);
Route::get('/project/index', [ProjectsController::class, 'index']);

// Model Task
Route::post('/task/create', [TasksController::class, 'store']);
Route::get('/task/show', [TasksController::class, 'show']);
Route::get('/task/index', [TasksController::class, 'index']);
Route::patch('/task/update', [TasksController::class, 'update']);

// Model Material
Route::post('/material/create', [MaterialsController::class, 'store']);
Route::get('/material/show', [MaterialsController::class, 'show']);
Route::get('/material/index', [MaterialsController::class, 'index']);
Route::patch('/material/update', [MaterialsController::class, 'update']);
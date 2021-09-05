<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FormController;
use App\Http\Controllers\API\ScoreController;
use App\Models\Score;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function(){

    // CRUD Student
    Route::post('/create', [FormController::class, 'create']);
    Route::get('/edit/{id}', [FormController::class, 'edit']);
    Route::put('/edit/{id}', [FormController::class, 'update']);
    Route::delete('/delete/{id}', [FormController::class, 'delete']);

    // CRUD score with relations to student
    Route::post('/create-score-student', [ScoreController::class, 'create']);
    Route::put('/student/{id}', [ScoreController::class, 'update']);

    // List student
    Route::get('/student', [ScoreController::class, 'allStudent']);
    Route::get('/student/{id}', [ScoreController::class, 'studentDetail']);

    Route::get('/logout', [AuthController::class, 'logout']);
});

// Data student dari database
// Route::get('student', [FormController::class, 'allStudent']);
// Route::get('student/{id}', [FormController::class, 'studentDetail']);

Route::post('/login', [AuthController::class, 'login']);
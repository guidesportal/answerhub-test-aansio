<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\External\SurveyAnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Rutas para los diferentes sistemas externos de encuestas.
|
*/

Route::prefix('survey-responses')->group(function () {

    Route::post('/system-a', [SurveyAnswerController::class, 'systemA']);

    Route::post('/system-b', [SurveyAnswerController::class, 'systemB']);

    Route::post('/system-c', [SurveyAnswerController::class, 'systemC']);

    Route::post('/system-d', [SurveyAnswerController::class, 'systemD']);

    Route::post('/system-e', [SurveyAnswerController::class, 'systemE']);

    Route::get('/system-f', [SurveyAnswerController::class, 'systemF']);

});

/**
 * Rutas CRUD para lectura
 */
Route::apiResource('users', UserController::class);
Route::apiResource('surveys', SurveyController::class);
Route::apiResource('questions', QuestionController::class);
Route::apiResource('answers', AnswerController::class);

<?php

use App\Http\Controllers\MainController;
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

Route::post('/get-titles', [MainController::class, 'listTitles']);
Route::post('/get-locales', [MainController::class, 'listLocales']);
Route::post('/check-email', [MainController::class, 'checkEmail']);
Route::post('/check-document', [MainController::class, 'checkDocument']);
Route::post('/submit-monthly-client', [MainController::class, 'submitNewMonthlyClient']);
Route::get('/get-pdf', [MainController::class, 'getPdf']);

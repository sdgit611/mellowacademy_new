<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DeveloperProfileController;
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


// Route::middleware('auth:sanctum')->get('/developer-profile', [DeveloperProfileController::class, 'developerProfileAPI']);
// Route::get('/developer-profile', [DeveloperProfileController::class, 'developerProfileAPI']);
// Route::middleware(['web'])->group(function () {
    Route::get('/developer-profile', [DeveloperProfileController::class, 'developerProfile']);
// });

Route::post('/developer-login', [DeveloperProfileController::class, 'developerLogin']);


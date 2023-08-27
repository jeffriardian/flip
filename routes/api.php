<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
//Route::prefix('api')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::get('balance-read', [UserController::class, 'getBalance'])->middleware('jwt.verify');
    Route::patch('topup-balance', [UserController::class, 'topUpBalance'])->middleware('jwt.verify');
    Route::post('transfer', [UserController::class, 'transfer'])->middleware('jwt.verify');
    Route::get('top-users', [UserController::class, 'topUser'])->middleware('jwt.verify');
    Route::get('top_transactions_per_user', [UserController::class, 'topTransactionUser'])->middleware('jwt.verify');
//});

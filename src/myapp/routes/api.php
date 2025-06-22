<?php

use App\Http\Controllers\ParkingLot\StatusController;
use App\Http\Controllers\ParkingSpot\ParkController;
use App\Http\Controllers\ParkingSpot\UnparkController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('parking-spot/{id}/park', ParkController::class);
Route::post('parking-spot/{id}/unpark', UnparkController::class);
Route::get('parking-lot', StatusController::class);

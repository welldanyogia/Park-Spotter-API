<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParkingLotController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
// Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Parking Lot
Route::get('/search-parking', [ParkingLotController::class, 'search']);
Route::get('/filter-parking', [ParkingLotController::class, 'filter']);
Route::get('/parking-details/{id}', [ParkingLotController::class, 'getDetails']);

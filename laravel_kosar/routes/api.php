<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('baskets', [BasketController::class, 'index']);
Route::get('baskets/{user_id}/{item_id}', [BasketController::class, 'show']);
Route::post('baskets', [BasketController::class, 'store']);
Route::put('baskets/{user}/{item}', [BasketController::class, 'update']);
Route::delete('baskets/{id}/{item}', [BasketController::class, 'destroy']);
Route::get('products', [ProductController::class, 'index']);


Route::middleware('auth.basic')->group(function () {    
    //  A - bejelentkezett felhasználó kosara
    Route::get('kosaram', [BasketController::class, 'kosaram']);
});

    // B - adott felhasználó termékei, melyek adott típusba tartoznak
Route::get('kosara/{neki}/{tipus}', [BasketController::class, 'kosara']);
    // C - összes 2 napnál régebbi kosár törlése
Route::delete('torlom', [BasketController::class, 'regiKosarTorles']);




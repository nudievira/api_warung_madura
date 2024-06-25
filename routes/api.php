<?php

use App\Http\Controllers\TransaksiController;
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

Route::group(['controller' => TransaksiController::class, 'prefix' => 'transaksi'], function () {
    Route::get('data-table', 'dataTable');
    Route::get('get-item', 'item');
    Route::post('store', 'store');
    Route::get('show/{id}', 'show');
    Route::get('update', 'update');
    Route::get('data-table-repot', 'dataTableReport');

});

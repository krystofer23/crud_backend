<?php

use App\Http\Controllers\TaskController;
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

Route::prefix('v1')->group(function () {

    Route::controller(TaskController::class)->prefix('task')->group(function () {

        Route::get('list', 'index');
        Route::post('create', 'store');
        Route::put('edit/{id}', 'update');
        Route::put('revert/{id}', 'revert');
        Route::put('finished/{id}', 'finished');
        Route::delete('delete/{id}', 'destroy');
    });
});

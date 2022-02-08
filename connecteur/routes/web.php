<?php

use App\Http\Controllers\AuthRequestController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthRequestController::class, 'login'])
    ->name('login');
Route::get('/login', [AuthRequestController::class, 'login'])
    ->name('login');

Route::post('/authenticated', [AuthRequestController::class, 'authenticated'])
    ->name('authenticated');

Route::post('/logout', [AuthRequestController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth'])->prefix('/')->group(function () {
    Route::get('/', [MessageController::class, 'index'])
        ->name('index');

    Route::get('/{discussion_id}', [MessageController::class, 'show'])
        ->name('show');

    Route::post('/{discussion_id}', [MessageController::class, 'store'])
        ->name('store');

});

//require __DIR__.'/auth.php';

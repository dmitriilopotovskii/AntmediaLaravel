<?php

use App\Http\Controllers\UserStreamController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserStreamController::class, 'index'])->name('dashboard');
    Route::get('/stream/create', [UserStreamController::class, 'create'])->name('create');
    Route::get('/stream/{id}', [UserStreamController::class, 'show'])->name('show');
    Route::post('/stream/', [UserStreamController::class, 'store']);
}
);

require __DIR__.'/auth.php';

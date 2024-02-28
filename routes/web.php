<?php

use App\Http\Controllers\ImmobileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/imovel/{id}', [HomeController::class, 'imovel'])->name('immobile.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/criar-imovel', [ImmobileController::class, 'create'])->name('create');
    Route::post('/criar-imovel', [ImmobileController::class, 'store'])->name('store')->middleware([HandlePrecognitiveRequests::class]);
    Route::get('/dashboard', [ImmobileController::class, 'show'])->name('dashboard');
    Route::delete('/delete/{id}', [ImmobileController::class, 'destroy'])->name('immobile.destroy');
    Route::put('/imovel/{id}', [ImmobileController::class, 'update'])->name('immobile.update')->middleware([HandlePrecognitiveRequests::class]);
    
    Route::post('/avaliacao/{id}', [HomeController::class, 'rating'])->name('rating')->middleware([HandlePrecognitiveRequests::class]);
});

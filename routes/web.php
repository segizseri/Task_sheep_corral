<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorralController;
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

Route::get('/', [CorralController::class, 'index'])->name('index');
Route::get('/reports/{id?}', [CorralController::class, 'myReports'])->name('myreports');
Route::post('/addRandom', [CorralController::class, 'addRandom'])->name('add.random');
Route::post('/kill', [CorralController::class, 'kill'])->name('kill.random');
Route::post('/switch', [CorralController::class, 'switchSheep'])->name('switch.sheep');
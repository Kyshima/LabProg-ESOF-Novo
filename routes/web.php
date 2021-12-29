<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
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

Route::get('/', [Controller::class, 'index']);
Route::get('/teste', [Controller::class, 'teste']);
Route::get('/list', [Controller::class, 'list']);

Route::get('/registerC', [Controller::class, 'registerC']);
Route::get('/registerE', [Controller::class, 'registerE']);

Auth::routes(['verify'=>true]);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/empresa/home', [HomeController::class, 'empresaIndex'])->name('empresa.home')->middleware('isEmpresa');

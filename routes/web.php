<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [Controller::class, 'index'])->name('first');

Route::get('/registerC', [Controller::class, 'registerC']);
Route::get('/registerE', [Controller::class, 'registerE']);

Auth::routes(['verify'=>true]);
Route::post('/email',[HomeController::class, 'email'])->name('email');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/empresa/home', [HomeController::class, 'empresaIndex'])->name('empresa.home')->middleware('isEmpresa');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/edit', [HomeController::class, 'edit'])->name('edit');
Route::get('/editPhoto', [HomeController::class, 'editPhoto'])->name('editPhoto');

Route::get('/delete', [HomeController::class, 'delete'])->name('delete');
Route::post('/erase', [HomeController::class, 'erase'])->name('erase');

Route::post('/update', [HomeController::class, 'update']);
Route::post('/save', [HomeController::class, 'store']);

Route::post('/generate-pdf', [HomeController::class, 'generatePDF']);
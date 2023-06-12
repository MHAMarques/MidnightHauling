<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\RoutesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [CompanyController::class, 'index']);

Route::get('/search', [CompanyController::class, 'search']);

Route::get('/hub', [CompanyController::class, 'index']);

Route::get('/off', [CompanyController::class, 'logoff']);


Route::get('/hub/{id}', [CompanyController::class, 'show']);

Route::get('/drivers/{id}', [MembersController::class, 'index']);

Route::get('/market/{id}', [MarketController::class, 'index']);

Route::get('/routes/{id}', [RoutesController::class, 'index']);

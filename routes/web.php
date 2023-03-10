<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController, RoleController, ShipmentController, PermissionController, GpspositionsController,
};
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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('shipments', ShipmentController::class);

        Route::resource('gpsposition', GpspositionsController::class);
    });

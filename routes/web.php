<?php

use GuzzleHttp\Middleware;
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

Auth::routes();


// Middleware route 
Route::middleware('auth')->group(function(){

    
    Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');
    Route::get('/dashboard/absen', 'Dashboard\AbsenController@index')->name('dashboard.absen');
    Route::get('/dashboard/materi', 'Dashboard\MateriController@index')->name('dashboard.materi');
    Route::get('/dashboard/langganan', 'Dashboard\LanggananController@index')->name('dashboard.langganan');

    
    // Users
    Route::get('/dashboard/users', 'Dashboard\UserController@index')->name('dashboard.users');
    Route::get('/dashboard/users/{id}', 'Dashboard\UserController@edit')->name('dashboard.users.edit');
    Route::put('/dashboard/users/{id}', 'Dashboard\UserController@update')->name('dashboard.users.update');
    Route::delete('/dashboard/users/{id}', 'Dashboard\UserController@destroy')->name('dashboard.users.delete');

});
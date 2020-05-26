<?php

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

Route::get('/pombos', 'PomboController@index');
Route::post('/pombo/update/{id}', 'PomboController@update');
Route::get('/pombo/profile/{id}', 'PomboController@profile')->name('pombo.profile');

Route::get('/pombais', 'PombalController@index');

Route::resource('pombo', 'PomboController');
Route::resource('pombal', 'PombalController');
// use "php artisan route:list" para ver as rotas
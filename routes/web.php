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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'PomboController@index')->middleware('auth');

Route::get('/pombos', 'PomboController@index')->middleware('auth');
Route::post('/pombo/update/{id}', 'PomboController@update')->middleware('auth');;
Route::get('/pombo/profile/{id}', 'PomboController@profile')->name('pombo.profile')->middleware('auth');;
Route::get('/pombo/pdf{id}', 'PomboController@geraPdf')->name('pombo.pdf')->middleware('auth');;

Route::get('/pombais', 'PombalController@index')->middleware('auth');;

Route::resource('pombo', 'PomboController')->middleware('auth');;
Route::resource('pombal', 'PombalController')->middleware('auth');;
// use "php artisan route:list" para ver as rotas
Auth::routes();

Route::get('/home', 'PomboController@index')->name('home')->middleware('auth');;

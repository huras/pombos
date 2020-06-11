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
Route::post('/pombo/update/{id}', 'PomboController@update')->middleware('auth');
Route::get('/pombo/profile/{id}', 'PomboController@profile')->name('pombo.profile')->middleware('auth');
Route::get('/pombo/pdf{id}', 'PomboController@geraPdf')->name('pombo.pdf')->middleware('auth');
Route::get('/pombo/exporta', 'PomboController@exporta')->name('pombo.exporta')->middleware('auth');

Route::get('/usuarios', 'Usuarios@index')->name('auth.index')->middleware('auth');
Route::post('/usuarios/store', 'Usuarios@store')->name('auth.store')->middleware('auth');
Route::get('/usuarios/create', 'Usuarios@create')->name('auth.create')->middleware('auth');
Route::get('/usuarios/edit/{id}', 'Usuarios@edit')->name('auth.edit')->middleware('auth');
Route::get('/usuarios/destroy/{id}', 'Usuarios@destroy')->name('auth.destroy')->middleware('auth');
Route::post('/usuarios/update/{id}', 'Usuarios@update')->middleware('auth');


Route::resource('pombo', 'PomboController')->middleware('auth');
Route::resource('pombal', 'PombalController')->middleware('auth');


// use "php artisan route:list" para ver as rotas
Auth::routes();

Route::get('/home', 'PomboController@index')->name('home')->middleware('auth');;

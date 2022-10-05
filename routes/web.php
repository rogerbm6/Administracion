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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);

	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);

	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	Route::get('map', function () {return view('pages.maps');})->name('map');

	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 

	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::get('descripciones', ['as' => 'descripcion.index', 'uses' => 'App\Http\Controllers\DescripcionController@index']);

	Route::get('clientes', ['as' => 'clientes.index', 'uses' => 'App\Http\Controllers\ClienteController@index']);

	Route::get('trabajadores', ['as' => 'trabajadores.index', 'uses' => 'App\Http\Controllers\TrabajadorController@index']);

	Route::get('productos', ['as' => 'productos.index', 'uses' => 'App\Http\Controllers\ProductoController@index']);

	Route::get('facturas', ['as' => 'facturas.index', 'uses' => 'App\Http\Controllers\FacturaController@index']);

	Route::get('casas', ['as' => 'casas.index', 'uses' => 'App\Http\Controllers\CasaController@index']);

	Route::get('entradas', ['as' => 'entradas.index', 'uses' => 'App\Http\Controllers\EntradaController@index']);
});


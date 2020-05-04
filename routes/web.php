<?php

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
    return view('content.content');
});

Route::get('/categoria', 'CategoriasController@index');
Route::post('/categoria/registrar', 'CategoriasController@store');
Route::put('/categoria/actualizar', 'CategoriasController@update');
Route::put('/categoria/desactivar', 'CategoriasController@desactivar');
Route::put('/categoria/activar', 'CategoriasController@activar');

Route::get('/producto', 'ProductoController@index');
Route::post('/producto/registrar', 'ProductoController@store');
Route::put('/producto/actualizar', 'ProductoController@update');
Route::put('/producto/desactivar', 'ProductoController@desactivar');
Route::put('/producto/activar', 'ProductoController@activar');
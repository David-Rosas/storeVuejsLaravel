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
Route::group(['middleware' => ['guest']], function () {

    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');

});

Route::group(['middleware' => ['auth']], function () {

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/main', function () {
        return view('content.content');
    })->name('main');



    Route::group(['middleware' => ['Comprador']], function () {

        Route::get('/categoria', 'CategoriasController@index');
        Route::post('/categoria/registrar', 'CategoriasController@store');
        Route::put('/categoria/actualizar', 'CategoriasController@update');
        Route::put('/categoria/desactivar', 'CategoriasController@desactivar');
        Route::put('/categoria/activar', 'CategoriasController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriasController@selectCategoria');

        Route::get('/producto', 'ProductoController@index');
        Route::post('/producto/registrar', 'ProductoController@store');
        Route::put('/producto/actualizar', 'ProductoController@update');
        Route::put('/producto/desactivar', 'ProductoController@desactivar');
        Route::put('/producto/activar', 'ProductoController@activar');

        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');

        Route::get('/compra', 'CompraController@index');
        Route::post('/registrar', 'CompraController@store');  
        Route::put('/desactivar', 'CompraController@desactivar');          

    });

    Route::group(['middleware' => ['Vendedor']], function () {

        Route::get('/categoria', 'CategoriasController@index');
        Route::post('/categoria/registrar', 'CategoriasController@store');
        Route::put('/categoria/actualizar', 'CategoriasController@update');
        Route::put('/categoria/desactivar', 'CategoriasController@desactivar');
        Route::put('/categoria/activar', 'CategoriasController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriasController@selectCategoria');

        Route::get('/producto', 'ProductoController@index');
        Route::post('/producto/registrar', 'ProductoController@store');
        Route::put('/producto/actualizar', 'ProductoController@update');
        Route::put('/producto/desactivar', 'ProductoController@desactivar');
        Route::put('/producto/activar', 'ProductoController@activar');

        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');

    });

    Route::group(['middleware' => ['Administrador']], function () {
        Route::get('/categoria', 'CategoriasController@index');
        Route::post('/categoria/registrar', 'CategoriasController@store');
        Route::put('/categoria/actualizar', 'CategoriasController@update');
        Route::put('/categoria/desactivar', 'CategoriasController@desactivar');
        Route::put('/categoria/activar', 'CategoriasController@activar');
        Route::get('/categoria/selectCategoria', 'CategoriasController@selectCategoria');
    
        Route::get('/producto', 'ProductoController@index');
        Route::post('/producto/registrar', 'ProductoController@store');
        Route::put('/producto/actualizar', 'ProductoController@update');
        Route::put('/producto/desactivar', 'ProductoController@desactivar');
        Route::put('/producto/activar', 'ProductoController@activar');
    
        Route::get('/proveedor', 'ProveedorController@index');
        Route::post('/proveedor/registrar', 'ProveedorController@store');
        Route::put('/proveedor/actualizar', 'ProveedorController@update');
    
        Route::get('/cliente', 'ClienteController@index');
        Route::post('/cliente/registrar', 'ClienteController@store');
        Route::put('/cliente/actualizar', 'ClienteController@update');
    
        Route::get('/role', 'RoleController@index');
        Route::get('/role/selectRol', 'RoleController@selectRole');
    
        Route::get('/user', 'UserController@index');
        Route::post('/user/registrar', 'UserController@store');
        Route::put('/user/actualizar', 'UserController@update');
        Route::put('/user/desactivar', 'UserController@desactivar');
        Route::put('/user/activar', 'UserController@activar');

        Route::get('/compra', 'CompraController@index');
        Route::post('/registrar', 'CompraController@store');  
        Route::put('/desactivar', 'CompraController@desactivar');
    
    });

});


//Route::get('/home', 'HomeController@index')->name('home');

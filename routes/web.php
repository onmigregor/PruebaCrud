<?php

		
use App\Concesionario;
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
     return view('index');
});

Route::get('vista-cliente', function () {
    return view('clientes');
});

Route::get('vista-concesionario', function () {
    return view('concesionario');
});

Route::get('reportesConcesionario', function () {
    return view('reportesConcesionario');
});

Route::get('reportesCiudad', function () {
    return view('reportesCiudad');
});




Route::resource('cliente', 'ClienteController');

Route::resource('concesionario', 'ConcesionarioController');

Route::resource('ciudad', 'CiudadController');






Route::post('reporteConcesionario', 'ReporteController@reporteConcesionario');

Route::post('reporteCiudad', 'ReporteController@reporteCiudad');

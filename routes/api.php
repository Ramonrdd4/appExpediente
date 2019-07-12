<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'expediente'], function ($router) {

        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('registar', 'AuthController@register');
        Route::post('registarMedico', 'AdministradorController@store');
        Route::post('registarPerfil', 'ProfileController@store');
        Route::get('perfil', 'ProfileController@show');
        Route::patch('actualizaadm', 'AdministradorController@update');
        Route::post('registarAsociado', 'PacienteController@store');
        Route::patch('actualizamedico', 'MedicoController@update');
        Route::patch('actualizapaciente', 'PacienteController@update');
        Route::resource('enfermedad', 'DeseaseController');
        Route::resource('alergia', 'AlergiaController');
        Route::resource('actividad', 'ActivityController');
    });

});

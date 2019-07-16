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
        //Login
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');

        //Usuarios registrar
        Route::post('registar', 'AuthController@register');
        Route::patch('actualizapaciente/{id}', 'PacienteController@update');
        Route::post('registarMedico', 'AdministradorController@store');
        Route::patch('actualizamedico/{id}', 'MedicoController@update');
        Route::patch('actualizaadm/{id}', 'AdministradorController@update');


        //Perfil
        Route::get('perfil', 'ProfileController@show');
        Route::post('registarPerfildueno', 'ProfileController@store');
        Route::post('registarPerfil', 'ProfileController@storeasociado');

        //Rutas enfermedad, alergia y actividad
        Route::resource('enfermedad', 'DeseaseController');
        Route::get('enfermedadEliminada', 'DeseaseController@showEliminadas');
        Route::get('restaurarEnfermedad/{id}', 'DeseaseController@restaurar');

        Route::resource('alergia', 'AlergiaController');
        Route::get('alergiaEliminada', 'AlergiaController@showEliminadas');
        Route::get('restaurarAlergia/{id}', 'AlergiaController@restaurar');

        Route::resource('actividad', 'ActivityController');
        Route::get('actividadEliminada', 'ActivityController@showEliminadas');
        Route::get('restaurarActividad/{id}', 'ActivityController@restaurar');


    });

});

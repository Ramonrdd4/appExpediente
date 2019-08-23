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
        Route::put('actualizaUsuario', 'AuthController@update');
        Route::patch('actualizaadm/{id}', 'AdministradorController@update');


        //Perfil
        Route::get('perfil', 'ProfileController@show');
        Route::post('registarPerfildueno', 'ProfileController@store');
        Route::post('registarPerfil', 'ProfileController@storeasociado');
        Route::get('perfil/{id}', 'ProfileController@showPerfil');

        //Expediente
        Route::post('registarExpediente', 'ExpedienteController@store');
        Route::get('mostrarExpediente/{id}', 'ExpedienteController@show');
        Route::get('listaAlergiasExpediente/{id}', 'ExpedienteController@listarAlergiasXPaciente');
        Route::get('listaDeseasesExpediente/{id}', 'ExpedienteController@listarEnfermedadesXPaciente');
        Route::get('listaMedicamentosExpediente/{id}', 'ExpedienteController@listarMedicamentosXPaciente');
        Route::get('listaActividadesExpediente/{id}', 'ExpedienteController@listarActividadesXPaciente');

        //Fumado
        Route::group(['prefix' => 'fumado'], function () {
            Route::get('show/{id}', 'FumadoController@show');
            Route::post('store', 'FumadoController@store');
            Route::patch('update/{id}', 'FumadoController@update');
        });

        //Alcohol
        Route::resource('alcohol', 'AlcoholController');

        //Cirugia
        Route::group(['prefix' => 'cirugias'], function () {
            Route::get('index/{id}', 'CirugiaController@index');
            Route::get('show/{id}', 'CirugiaController@show');
            Route::post('store', 'CirugiaController@store');
            Route::patch('update/{id}', 'CirugiaController@update');
        });

        //Rutas enfermedad, alergia y actividad
        Route::resource('enfermedad', 'DeseaseController');
        Route::get('enfermedadEliminada', 'DeseaseController@showEliminadas');
        Route::get('restaurarEnfermedad/{id}', 'DeseaseController@restaurar');
        //agregar alergia,enfermedad y actividad a expediente
        Route::post('agregaActividad', 'ActivityController@storeActividadxUsuario');
        Route::post('agregaEnfermedad', 'DeseaseController@storeEnfermedadesxUsuario');
        Route::post('agregaAlergia', 'AlergiaController@storeAlergiasxUsuario');
        Route::post('agregaimagenAlergia/{id}', 'AlergiaController@storeImagen');
        Route::post('agregaimagenEnfermedad/{id}', 'DeseaseController@storeImagen');
        Route::post('agregaimagenActividad/{id}', 'ActivityController@storeImagen');
        Route::get('obtenerImagenAlergia/{filename}', 'AlergiaController@ObtenerImagen');
        Route::get('obtenerImagenEnfermedad/{filename}', 'DeseaseController@ObtenerImagen');
        Route::get('as/{filename}', 'ActivityController@ObtenerImagen');


        Route::resource('alergia', 'AlergiaController');
        Route::get('alergiaEliminada', 'AlergiaController@showEliminadas');
        Route::get('restaurarAlergia/{id}', 'AlergiaController@restaurar');
        Route::post('alergiaXexpediente', 'AlergiaController@storeAlergiaxUsuario');

        Route::resource('actividad', 'ActivityController');
        Route::get('actividadEliminada', 'ActivityController@showEliminadas');
        Route::get('restaurarActividad/{id}', 'ActivityController@restaurar');

        //Rutas de medicamentos
        Route::group(['prefix' => 'medicamentos'], function ($router){
            Route::post('medicamentoXexpediente', 'MedicamentoController@storeMedicamentoXUsuario');
        });
        Route::resource('medicamento', 'MedicamentoController');

        //Rutas de alergias frecuentes
        Route::group(['prefix' => 'listaAlergias'], function ($router){
            Route::patch('eliminarDeListaFrecuente/{id}', 'ListaAlergiaController@eliminarDeLista');
        });
        Route::resource('listaAlergias', 'ListaAlergiaController');
        //Rutas de actividades frecuentes
        Route::group(['prefix' => 'listaActivities'], function ($router){
            Route::patch('eliminarDeListaFrecuente/{id}', 'ListaActivityController@eliminarDeLista');
        });
        Route::resource('listaActivities', 'ListaAlergiaController');
        //Ruta de enfermedades frecuentes
        Route::group(['prefix' => 'listaDeseases'], function ($router){
            Route::patch('eliminarDeListaFrecuente/{id}', 'ListaDeseaseController@eliminarDeLista');
        });
        Route::resource('listaDeseases', 'ListaDeseaseController');

        //Crear un servio consulta
        Route::group(['prefix' => 'medico'], function ($router){
            Route::post('agregarServicio', 'ServicioConsultasController@store');
            Route::patch('actualizaServicio/{id}', 'ServicioConsultasController@update');
            Route::post('agregaHorario', 'HorarioController@store');
            Route::get('detalleAgendaMedico/{id}', 'AgendaController@detalleAgendaMedico');
            Route::get('listaHorariosSinasignar', 'HorarioController@index');
            Route::delete('horario/{id}', 'HorarioController@destroy');
            Route::get('horario_medico/{id}', 'HorarioController@HorariosMedico');
            //
            Route::get('horariopaciente/{id}', 'AgendaController@AgendaPaciente');
            //show
            Route::get('AgendaPaciente/{id}', 'AgendaController@show');
            Route::get('especialidades', 'EspecialidadController@index');
            Route::get('Listamedicos', 'MedicoController@index');

        });

        Route::group(['prefix' => 'compartir'], function ($router){
            Route::post(
                'compartirE','CompartirController@compartir_expediente'
            );
            Route::get(
                'expedientescompartidos',
                'CompartirController@expedientesCompartidosUuario'
            );
            Route::get(
                'usuariosCompartidos/{id}',
                'CompartirController@usuariosCompartidoExpediente'
            );
            Route::get(
                'UsuariosCompartir',
                'AuthController@showUusarios'
            );
        });

        //Cita
        Route::group(['prefix' => 'cita'], function ($router){
            Route::post('ListaHorario/{id}', 'HorarioController@show');
            Route::post('agregaAgenda', 'AgendaController@store');
            Route::get('ListaServicio/{id}', 'ServicioConsultasController@show');
            Route::get('ListaServicios', 'ServicioConsultasController@index');
            Route::get('HorarioMedico/{id}', 'HorarioController@HorarioMedico');
            Route::get('Servicio/{id}', 'ServicioConsultasController@showServicio');
        });

    });

});

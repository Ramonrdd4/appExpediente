<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use JWTAuth;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //El usuario Paciente cra los perfiles
        //Crear un Medico
      try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        $this->validate($request, [
                'id'=>'required|min:9',
                'nombre' => 'required|min:5',
                'primerApellido' => 'required|min:6',
                'segundoApellido' => 'required|min:6',
                'sexo' => 'required|min:1',
                'fechaNacimiento'=> 'required|date',
                'tipoSangre'=> 'required|min:2',
                'direccion'=> 'required|min:5',
                'numTelefonico'=>'required|numeric|min:0',
                'contactoEmergencia'=>'required|numeric|min:0',

        ]);
    } catch (\Illuminate\Validation\ValidationException $e ) {
        return \response($e->errors(),422);
    }
    if (Gate::allows('solo_pacientedueno',$user )) {
    $perfil = new Profile();
    $perfil->id = $request->id;
    $perfil->nombre = $request->nombre;
    $perfil->primerApellido = $request->primerApellido;
    $perfil->segundoApellido = $request->segundoApellido;
    $perfil->sexo = $request->sexo;
    $perfil->fechaNacimiento = $request->fechaNacimiento;
    $perfil->tipoSangre = $request->tipoSangre;
    $perfil->direccion = $request->direccion;
    $perfil->numTelefonico = $request->numTelefonico;
    $perfil->contactoEmergencia = $request->contactoEmergencia;
    //trae el perfil que sea dueño
    $perfil1 = Profile::where('idUsuario', $user->id)->where('esDuenho',true)->get();
    //valida el perfil si existe el due;o lo pone false y si no lo pone true
     if ($perfil1!=null) {
        $perfil->esDuenho = false;
        }else{
            $perfil->esDuenho = true;
        }
    $perfil->user()->associate($user->id);
    if( $perfil->save()){
        return response()->json(['user' => $perfil]);
    }else{
        $response = ['Msg'=>'Error al registrar el perfil, por favor intentelo más tarde!'];
        return response()->json($response,404);
    }

}else {
    $response = ['Msg'=>'No Autorizado'];
    return response()->json($response,404);
}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
     //Muestra todas las Perfiles del usuario
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        if (Gate::allows('solo_pacientedueno',$user )) {
    $perfil = Profile::where('idUsuario', $user->id)->get();
    $response=[

        'msg' => 'Lista de Perfil',
        'Perfil' => $perfil,
    ];
    return response()->json($response, 200);
    }else{
    $response = ['Msg'=>'No Autorizado'];
    return response()->json($response,404);
    }
        } catch (\Throwable $th) {
    return \response($th->getMessage(), 422);
    }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
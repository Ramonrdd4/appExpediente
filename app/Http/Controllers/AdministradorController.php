<?php

namespace App\Http\Controllers;

use App\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use JWTAuth;

class AdministradorController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //Crear un Paciente Asociado
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg'=>'Usuario no encontrado'], 404);
            }
            $this->validate($request, [
                'email' => 'required|email',
                    'nombre' => 'required|min:5',
                    'primerApellido' => 'required|min:6',
                    'segundoApellido' => 'required|min:6',
                    'sexo' => 'required|min:1',
                    'password' => 'required|min:6'
            ]);



        } catch (\Illuminate\Validation\ValidationException $e ) {
            return \response($e->errors(),422);
        }
        if (Gate::allows('solo_pacientedueno',$user )) {
        $user1 = new User();
        $user1->email = $request->email;
        $user1->nombre = $request->nombre;
        $user1->primerApellido = $request->primerApellido;
        $user1->segundoApellido = $request->segundoApellido;
        $user1->sexo = $request->sexo;
        $user1->password = bcrypt($request->password);
        $user1->rol()->associate(2);
        $user1->save();
        return response()->json(['user' => $user1]);
    }else {
        $response = ['Msg'=>'No Autorizado'];
        return response()->json($response,404);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function show(Administrador $administrador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrador $administrador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrador $administrador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Administrador  $administrador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrador $administrador)
    {
        //
    }
}

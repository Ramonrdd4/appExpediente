<?php

namespace App\Http\Controllers;

use App\Medico;
use App\Servicio_Consulta;
use App\User;
use JWTAuth;

use Illuminate\Http\Request;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('rol_id', 2)->get();
        $response=[

            'msg' => 'Lista de Medicos',
            'Medicos' => $user,
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function edit(Medico $medico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medico $medico)
    {
          //se modifica el El medico
          try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg'=>'Usuario no encontrado'], 404);
            }
            $this->validate($request, [
                    'nombre' => 'required|min:5',
                    'primerApellido' => 'required|min:6',
                    'segundoApellido' => 'required|min:6',
                    'sexo' => 'required|min:1',
                    'password' => 'required|min:6'
            ]);



        } catch (\Illuminate\Validation\ValidationException $e ) {
            return \response($e->errors(),422);
        }
        if (Gate::allows('solo_medico',$user )) {
        $user1 = User::find($user->id);
        $user1->nombre = $request->nombre;
        $user1->primerApellido = $request->primerApellido;
        $user1->segundoApellido = $request->segundoApellido;
        $user1->sexo = $request->sexo;
        $user1->password = bcrypt($request->password);
        $user1->save();
        return response()->json(['user' => $user1]);
    }else {
        $response = ['Msg'=>'No Autorizado'];
        return response()->json($response,404);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medico $medico)
    {
        //
    }
    public function responseErrors($errors, $statusHTML)
    {
        $transformed = [];

        foreach ($errors as $field => $message) {
            $transformed[] = [
                'field' => $field,
                'message' => $message[0]
            ];
        }

        return response()->json([
            'errors' => $transformed
        ], $statusHTML);
    }
}

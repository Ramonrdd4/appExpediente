<?php

namespace App\Http\Controllers;

use App\servicio__consultas;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Gate;

class ServicioConsultasController extends Controller
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
        //Crear servicio de consulta doctor
        try {
            $this->validate($request, [
                    'Precio' => 'required|numeric:5',
                    'Ubicacion' => 'required|min:6',
                    'id_doctor' => 'required|min:1',
                    'especialidad_id' => 'required|min:1',
            ]);



        } catch (\Illuminate\Validation\ValidationException $e ) {
             return $this->responseErrors($e->errors(), 422);
        }
        if (Gate::allows('solo_medico',$user )) {
        $servicioConsulta = new servicio__consultas();
        $servicioConsulta->precio = $request->Precio;
        $servicioConsulta->ubicacion = $request->Ubicacion;
        $servicioConsulta->especialidad()->associate($request->especialidad_id);
        $servicioConsulta->user()->associate($request->id_doctor);
        $servicioConsulta->save();

        return response()->json(['Servicio Consulta' => $servicioConsulta]);
    }else {
        $response = ['Msg'=>'No Autorizado'];
        return response()->json($response,404);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\servicio__consultas  $servicio__consultas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //muestra los servicios por medico
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
         return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
    } catch (\Illuminate\Validation\ValidationException $e ) {
            return $this->responseErrors($e->errors(), 422);
            }

     if (Gate::allows('solo_medico',$user )) {
        $servicio= servicio__consultas::where('id_Doctor',$id)->get();
          $response=[
            'msg' => 'Lista de Servicio Consulta',
            'Horario' => $servicio,
        ];
        return response()->json($response, 200);
        }else{
        $response = ['Msg'=>'No Autorizado'];
        return response()->json($response,404);
        }

            }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\servicio__consultas  $servicio__consultas
     * @return \Illuminate\Http\Response
     */
    public function edit(servicio__consultas $servicio__consultas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\servicio__consultas  $servicio__consultas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, servicio__consultas $servicio__consultas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\servicio__consultas  $servicio__consultas
     * @return \Illuminate\Http\Response
     */
    public function destroy(servicio__consultas $servicio__consultas)
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

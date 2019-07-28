<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fumado;
use App\Expediente;

class FumadoController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $this -> validate($request, [
                'expediente_id'=>'required|min:9',
                'estadoFumado'=> 'required|numeric:1',
                'tiempoInicio'=>'required',
                'frecuencia'=> 'required|numeric',
                'observaciones'=>'required'
            ]);
            /*if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'], 404);
            }*/
        }
        catch(\Illuminate\Validation\ValidationException $e){
            return \response($e->errors(),422);
        }
        $expedinte = Expediente::where('idperfil', $request->input('expediente_id'))->get();
        if($expedinte == null){
            return response()->json(['msg'=>'Expediente no encontrado'], 404);
        }
        $fumado = Fumado::where('id', $request->input('expediente_id'))->get();
        if($fumado != null){
            return response()->json(['msg'=>'El expediente ya cuenta con un registro de fumado'], 404);
        }
        $fumado = new Fumado([
            'id'=> $request->input('expediente_id'),
            'estadoFumado'=> $request->input('estadoFumado'),
            'tiempoInicio'=> $request->inptu('tiempoInicio'),
            'frecuencia'=> $request->inptu('frecuencia'),
            'observaciones' => $request ->input('observaciones')
        ]);

        if($fumado->save()){
            $fumado->expediente()->associate($request->input('expediente_id'));
            $expedinte = Expediente::where('idperfil',$request->input('expediente_id'))->with('fumado')->getFirst();
            $response=[
                'msg' => 'Registro de Fumado guardado',
                'Expediente' => $expedinte
            ];
            return response()->json($response, 200);
        }
        return response()->json($response, 404);
    }


    public function show($id)
    {
        try
        {
            /*if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg'=>'Usuario no encontrado'], 404);
            }*/
            $fumado = Fumado::find($id);
            if($fumado != null){
                $response = [
                    'Registro de Fumado' => $fumado
                ];
                return response()->json($response, 200);
            }else{
                return response()->json(['msg'=> 'Registro no encontrado'], 200);
            }
        }catch (\Throwable $th) {
            return \response($th->getMessage(), 422);
            }
    }

    public function update(Request $request, $id)
    {
        try
        {
            $this -> validate($request, [
                'estadoFumado'=> 'required|numeric|min:1',
                'tiempoInicio'=>'required',
                'frecuencia'=> 'required|numeric',
                'observaciones'=>'required'
            ]);
            /*if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'], 404);
            }*/
        }catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $fumado = Fumado::find($id);
        $fumado->estadoFumado = $request->input('estadoFumado');
        $fumado->tiempoInicio = $request->input('tiempoInicio');
        $fumado->frecuencia = $request->input('frecuencia');
        $fumado->observaciones = $request->input('observaciones');

        if($fumado->save()){
            $response=[
                'msg' => 'Registro de Fumado actualizado',
                'Registro' => $fumado
            ];
            return response()->json($response, 201);
        }
        $response=[
            'msg'=>'Error durante la actualización'
        ];
        return response()->json($response, 404);

    }
}

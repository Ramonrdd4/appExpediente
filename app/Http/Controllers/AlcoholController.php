<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Http\Request;

class AlcoholController extends Controller
{
    //
=======
use App\Alcohol;
use App\Expediente;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class AlcoholController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $this -> validate($request, [
                'expediente_id'=>'required|min:9',
                'estadoAlcohol'=> 'required|numeric:1',
                'tiempoInicio'=>'required',
                'frecuencia'=> 'required|numeric',
                'tipoLicor'=> 'required',
                'cantidad' => 'required|numeric',
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
            return response()->json(['msg'=>'Expediente especificado no encontrado'], 404);
        }
        $alcohol = Alcohol::where('id', $request->input('expediente_id'))->get();
        if($alcohol != null){
            return response()->json(['msg'=>'El expediente ya cuenta con un registro de alcoholismo'], 404);
        }
        $alcohol = new Alcohol([
            'id'=> $request->input('expediente_id'),
            'estadoAlcohol'=> $request->input('estadoAlcohol'),
            'tiempoInicio'=> $request->input('tiempoInicio'),
            'frecuencia'=> $request->input('frecuencia'),
            'tipoLicor' => $request->input('tipoLicor'),
            'cantidad' => $request->input('cantidad'),
            'observaciones' => $request ->input('observaciones')
        ]);

        if($alcohol->save()){
            $alcohol->expediente()->associate($request->input('expediente_id'));
            $expedinte = Expediente::find($request->input('expediente_id'))->with('alcohol')->get();
            $response=[
                'msg' => 'Registro de Alcoholismo guardado',
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
            $alcohol = Alcohol::find($id);
            if($alcohol != null){
                $response = [
                    'Registro de Alcoholismo' => $alcohol
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
                'estadoAlcohol'=> 'required|numeric:1',
                'tiempoInicio'=>'required',
                'frecuencia'=> 'required|numeric',
                'tipoLicor'=> 'required',
                'cantidad' => 'required|numeric',
                'observaciones'=>'required'
            ]);
            /*if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'], 404);
            }*/
        }catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $alcohol = Alcohol::find($id);
        $alcohol->estadoAlcohol = $request->input('estadoAlcohol');
        $alcohol->tiempoInicio = $request->input('tiempoInicio');
        $alcohol->tipoLicor = $request->input('tipoLicor');
        $alcohol->cantidad = $request->input('cantidad');
        $alcohol->observaciones = $request->input('observaciones');

        if($alcohol->save()){
            $response=[
                'msg' => 'Registro de Alcoholismo actualizado',
                'Registro' => $alcohol
            ];
            return response()->json($response, 201);
        }
        $response=[
            'msg'=>'Error durante la actualización'
        ];
        return response()->json($response, 404);

    }
>>>>>>>

}

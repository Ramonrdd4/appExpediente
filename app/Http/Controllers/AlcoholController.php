<?php

namespace App\Http\Controllers;

use App\Alcohol;
use App\Profile;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class AlcoholController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $this -> validate($request, [
                'perfil_id'=>'required|min:9',
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
        $perfil = Profile::where('id', $request->input('perfil_id'))->get();
        if($perfil == null){
            return response()->json(['msg'=>'Perfil especificado no encontrado'], 404);
        }
        $alcohol = Alcohol::where('id', $request->input('perfil_id'))->get();
        if($alcohol != null){
            return response()->json(['msg'=>'Ya existe un registro de alcoholismo con la identificación especificada'], 403);
        }
        $alcohol = new Alcohol([
            'id'=> $request->input('perfil_id'),
            'estadoAlcohol'=> $request->input('estadoAlcohol'),
            'tiempoInicio'=> $request->input('tiempoInicio'),
            'frecuencia'=> $request->input('frecuencia'),
            'tipoLicor' => $request->input('tipoLicor'),
            'cantidad' => $request->input('cantidad'),
            'observaciones' => $request ->input('observaciones')
        ]);

        if($alcohol->save()){
            $alcohol= Alcohol::find($request->input('perfil_id'));
            $response=[
                'msg' => 'Registro de Alcoholismo guardado',
                'Registro' => $alcohol
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
                    'msg' => 'Registro de Alcoholismo',
                    'alcohol' => $alcohol
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cirugia;
use App\Expediente;

class CirugiaController extends Controller
{
    public function index($id)
    {
        try
        {
            /*if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'], 404);
            }*/
            $cirugias = Cirugia::where('idExpediente', $id)->get();
            $response = [
                'msg' => 'Lista de Cirugías',
                'Ciruguias' => $cirugias
            ];
            return response()->json($response, 200);
        }catch (\Throwable $th) {
            return \response($th->getMessage(), 422);
        }
    }

    public function show($id)
    {
        try
        {
            /*if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'], 404);
            }*/
            $cirugia = Cirugia::find($id);
            if($cirugia != null)
            {
                return response()->json($cirugia, 200);
            }
            else
            {
                return response()->json(['msg'=>'Cirguia no encontrada'], 404);
            }
        }catch(\Throwable $th) {
            return \response($th->getMessage(), 422);
            }
    }

    public function store(Request $request)
    {
        try
        {
            $this -> validate($request, [
                'fecha' =>'required|date',
                'lugar'=>'required',
                'expediente_id' => 'required|numeric|min:1',
            ]);
            /*if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }*/
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $expediente = Expediente::where('idperfil', $request->input('expediente_id'))->get();
        if($expediente == null)
        {
            return response()->json(['msg'=>'Expediente especificado no encontrado']);
        }
        $cirugia = new Cirugia([
            'fecha'=> $request->input('fecha'),
            'lugar'=> $request->input('lugar'),
            'idExpediente'=> $request->input('expediente_id')
        ]);

        if($cirugia->save()){
            $cirugia->expediente()->associate($request->input('expediente_id'));
            $cirugias = Cirugia::where('idExpediente', $request->input('expediente_id'))->get();
            $response = [
                'msg' => 'Registro de cirugía exitoso',
                'Cirugias' => $cirugias
            ];
            return response()->json($response, 200);
        }
        return response()->json(['msg'=>'Error durante el registro'], 404);
    }


    public function update(Request $request, $id)
    {
        try
        {
            $this -> validate($request, [
                'fecha' =>'required|date',
                'lugar'=>'required',
                'idExpediente' => 'required|numeric|min:1',
            ]);
            /*if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }*/
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        $expediente = Expediente::find($request->input('idExpediente'));
        if($expediente == null)
        {
            return response()->json(['msg'=>'Expediente especificado no encontrado']);
        }
        $cirugia = Cirugia::find($id);
        if($cirugia == null)
        {
            return response()->json(['msg'=>'Cirugía especificada no encontrada']);
        }
        $cirugia->fecha = $request->input('fecha');
        $cirugia->lugar = $request->input('lugar');
        if($cirugia->save()){
            $cirugias = Cirugia::where('idExpediente', $request->input('idExpediente'))->get();
            return response()->json($cirugias, 202);
        }
        return response()->json(['msg'=>'Error durante la actualización']);
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

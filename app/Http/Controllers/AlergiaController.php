<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alergia;
use Illuminate\Support\Facades\Gate;
use App\User;
use JWTAuth;
use App\Expediente;

class AlergiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //Muestra todas las Alergias menos las eliminadas
    try {
        $alergia = Alergia::all();
        $response=[

            'msg' => 'Lista de Alergias',
            'Alergia' => $alergia,
        ];
        return response()->json($response, 200);
    } catch (\Throwable $th) {
        return \response($th->getMessage(), 422);
        }
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this -> validate($request, [
                'nombre'=>'required|min:5',
                'categoria'=>'required',
                'reaccion'=>'required',
                'observaciones'=>'required',
            ]);
            //Obtener el usuario autentificado actual
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }

        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        if (Gate::allows('solo_adm',$user )) {
        $alergia = new Alergia([
            'nombre'=>$request->input('nombre'),
            'categoria'=>$request->input('categoria'),
            'reaccion'=>$request->input('reaccion'),
            'observaciones'=>$request->input('observaciones')
        ]);

        if($alergia->save()){

            $response=[
                'msg'=> 'Alergia registrada',
                'alergia'=> $alergia
            ];
            return response()->json($response, 201);
        }
        $response=[
            'msg'=>'Error durante el registro'
        ];
        return response()->json($response, 404);
          }else{
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
    public function show($id)
    {
         //Muestra la alergia especifica
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        if (Gate::allows('solo_adm',$user )) {
    $alergia = Alergia::where('id', $id)->get();
    $response=[

          'Alergia' => $alergia,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Actualizar Alergia
        try{
            $this -> validate($request, [
                'nombre'=>'required|min:5',
                'categoria'=>'required',
                'reaccion'=>'required',
                'observaciones'=>'required',
            ]);
            //Obtener el usuario autentificado actual
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }

        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        if (Gate::allows('solo_adm',$user )) {
        $alergia = Alergia::find($id);
            $alergia->nombre = $request->nombre;
            $alergia->categoria = $request->categoria;
            $alergia->reaccion = $request->reaccion;
            $alergia->observaciones = $request->observaciones;

        if($alergia->save()){

            $response=[
                'msg'=> 'Alergia actualizada con exito!',
                'alergia'=> $alergia
            ];
            return response()->json($response, 201);
        }
        $response=[
            'msg'=>'Error durante la actualización'
        ];
        return response()->json($response, 404);
          }else{
        $response = ['Msg'=>'No Autorizado'];
        return response()->json($response,404);
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        if (Gate::allows('solo_adm',$user )) {


        if( $alergia = Alergia::find($id)){
            $alergia->delete();
            $response = ['Msg'=>'Alergia eliminada con exito!'];
        }else{
            $response=['Msg' => 'Alegia no existe!'];
        }
        return response()->json($response,200);
      }else {
        $response = ['Msg'=>'No Autorizado'];
        return response()->json($response,404);
    }
    }
    //Restaurar datos
    public function restaurar($id)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        if (Gate::allows('solo_adm',$user )) {


        if(  Alergia::onlyTrashed()->find($id)->restore()){
            $response = ['Msg'=>'Alergia restaurada con exito!'];
        }else{
            $response=['Msg' => 'Alegia no existe!'];
        }
        return response()->json($response,200);
      }else {
        $response = ['Msg'=>'No Autorizado'];
        return response()->json($response,404);
    }
    }

    //Metodo del usuario (Ramon)
    public function storeAlergiaxUsuario(Request $request)
    {
        try{
            $this -> validate($request, [
                'alergia_id'=>'required|numeric|min:1',
                'expediente_id'=>'required|numeric'
            ]);
            //Obtener el usuario autentificado actual
           /* if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            } */

        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }

        $alergia = Alergia::find($request->input('alergia_id'));
        $expediente = Expediente::find($request->input('expediente_id'));


        if($alergia != null and $expediente != null){
            //Asociar con expediente
            $alergia->expedientes()->attach($request->input('expediente_id')=== null ? [] : $request->input('expediente_id'));
            $expediente = Expediente::find($request->input('expediente_id'))->with('alergias')->first();
            $response=[
                'msg'=> 'Alergia registrada al expediente',
                'Expediente'=> $expediente
            ];
            return response()->json($response, 201);
        }
        $response=[
            'msg'=>'Error durante el registro'
        ];
        return response()->json($response, 404);
    }
    public function showEliminadas()
    {
        //Muestra todas las alergias eliminadas
        try {
            $actividad = Alergia::onlyTrashed()->get();
            $response=[

                'msg' => 'Lista de Alergias eliminadas',
                'Alergia' => $actividad,
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return \response($th->getMessage(), 422);
        }
    }
}

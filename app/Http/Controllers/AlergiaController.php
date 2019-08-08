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
           return $this->responseErrors($e->errors(), 422);
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

            $alergia = Alergia::where('id', $id)->get();
            $response = [
                'msg' => 'Información sobre la alergia',
                'Alergia' => $alergia
            ];
            return response()->json($response, 200);
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
                'categorias'=>'required',
                'reaccion'=>'required',
                'observaciones'=>'required',
            ]);
            //Obtener el usuario autentificado actual
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }

        }
        catch (\Illuminate\Validation\ValidationException $e) {
           return $this->responseErrors($e->errors(), 422);
        }
        if (Gate::allows('solo_adm',$user )) {
        $alergia = Alergia::find($id);
            $alergia->nombre = $request->input('nombre');
            $alergia->categoria = $request->input('categorias');
            $alergia->reaccion = $request->input('reaccion');
            $alergia->observaciones = $request->input('observaciones');

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
           return $this->responseErrors($e->errors(), 422);
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
        //Metodo del usuario (Fabiola)
        public function storeAlergiasxUsuario(Request $request)
        {
          try{
              $this -> validate($request, [
                  'expediente_id'=>'required|numeric:9',
                  'alergia_id'=>'required|numeric:1'
              ]);
              //Obtener el usuario autentificado actual
              if(!$user = JWTAuth::parseToken()->authenticate()){
                  return response()->json(['msg'=>'Usuario no encontrado'],404);
              }
          }
          catch (\Illuminate\Validation\ValidationException $e) {
             return $this->responseErrors($e->errors(), 422);
          }
          if (Gate::allows('solo_pacientedueno',$user )) {
              $expediente = Expediente::where('idperfil', $request->input('expediente_id'))->first();
              $alergia = Alergia::where('id',$request->input('alergia_id'))->first();

              if($expediente===null){
                  return response()->json("Expediente no encontrado");
              }
              if($alergia->nombre=="Otro"){
                $nombre=$request->input('nombre');
                $reaccion=$request->input('reaccion');
                $observaciones=$request->input('observaciones');
                $categoria=$request->input('categoria');
                $expediente->alergias()->attach($alergia->id,['nombre'=>$nombre,'categoria'=>$categoria,'reaccion'=>$reaccion,'observaciones'=>$observaciones]);
              }else{
                //Asocia con el expediente
                $expediente->alergias()->attach($alergia->id);
              }


              $response =[
                  'msg'=>'Alergia agregada exitosamente!',
              ];
              return response()->json($response, 200);

          }else {
              $response = ['Msg'=>'No Autorizado'];
              return response()->json($response,404);
          }
      }

      public function storeAlergiaDeUsuario(Request $request, $id)
      {
          try{
              $this -> validate($request, [
                  'nombre'=>'required|min:5',
                  'categoria'=>'required',
                  'reaccion'=>'required',
                  'observaciones'=>'required',
                  'expediente_id' => 'required|numeric|min:16'
              ]);
              //Obtener el usuario autentificado actual
              if(!$user = JWTAuth::parseToken()->authenticate()){
                  return response()->json(['msg'=>'Usuario no encontrado'],404);
              }
              $expediente = Expediente::find($id);


          }
          catch (\Illuminate\Validation\ValidationException $e) {
             return $this->responseErrors($e->errors(), 422);
          }
          if (Gate::allows('solo_pacientedueno',$user )) {
          $alergia = new Alergia([
              'nombre'=>$request->input('nombre'),
              'categoria'=>$request->input('categoria'),
              'reaccion'=>$request->input('reaccion'),
              'observaciones'=>$request->input('observaciones')
          ]);

          if($alergia->save()){
            $expediente->alergias()->attach($alergia);
            $expediente = Expediente::where('id', $id)->with('alergias');
              $response=[
                  'msg'=> 'Alergia registrada',
                  'alergia'=> $alergia,
                  'expediente' => $expediente
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

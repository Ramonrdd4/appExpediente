<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Desease;
use Illuminate\Support\Facades\Gate;
use App\User;
use JWTAuth;
use App\Expediente;
class DeseaseController extends Controller
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
        $desease = Desease::all();
        $response=[

        'msg' => 'Lista de Enfermedades',
        'Enfermedad' => $desease,
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
        $desease = new Desease([
            'nombre'=>$request->input('nombre'),
            'observaciones'=>$request->input('observaciones')
        ]);

        if($desease->save()){

            $response=[
                'msg'=> 'Enfermedad registrada',
                'desease'=> $desease
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
           //Muestra la enfermedad especifica
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        if (Gate::allows('solo_adm',$user )) {
    $desease = Desease::where('id', $id)->get();
    $response=[

          'Enfermedad' => $desease,
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
        //Actualización de Enfermedad
        try{
            $this -> validate($request, [
                'nombre'=>'required|min:5',
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
        $desease = Desease::find($id);
        $desease->nombre=$request->nombre;
        $desease->observaciones =$request->observaciones;


        if($desease->save()){

            $response=[
                'msg'=> 'Enfermedad actualizada con exito',
                'desease'=> $desease
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
            if($desease = Desease::find($id)){
              $desease->delete();
              $response = ['Msg'=>'Enfermedad eliminada con exito!'];
            }else{
                $response = ['Msg'=>'Enfermedad no existe!'];
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

        if(Desease::onlyTrashed()->find($id)->restore()){
            $response = ['Msg'=>'Enfermedad restaurada con exito!'];
        }else{
            $response=['Msg' => 'Enfermedad no existe!'];
        }
        return response()->json($response,200);
      }else {
        $response = ['Msg'=>'No Autorizado'];
        return response()->json($response,404);
    }
    }
//Metodo del usuario (Ramon)
    public function storeDeseaseUsuario(Request $request)
    {
        try{
            $this -> validate($request, [
                'nombre'=>'required|min:5',
                'observaciones'=>'required',
                'expediente'=>'required|numeric:9'
            ]);
            //Obtener el usuario autentificado actual
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }

        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }

        $desease = new Desease([
            'nombre'=>$request->input('nombre'),
            'observaciones'=>$request->input('observaciones')
        ]);

        if($desease->save()){
            //Asociar con expediente
            $desease->expedientes()->attach($request->input('expediente')=== null ? [] : $request->input('expediente'));

            $response=[
                'msg'=> 'Enfermedad registrada',
                'desease'=> $desease
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
        //Muestra todas las enfermedades eliminadas
        try {
            $actividad = Desease::onlyTrashed()->get();
            $response=[

                'msg' => 'Lista de enfermedades eliminadas',
                'Enfermedad' => $actividad,
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return \response($th->getMessage(), 422);
        }
    }
    //Metodo del usuario (Fabiola)
    public function storeEnfermedadesxUsuario(Request $request)
    {
      try{
          $this -> validate($request, [
              'expediente_id'=>'required|numeric:9',
              'enfermedad_id'=>'required|numeric:1'
          ]);
          //Obtener el usuario autentificado actual
          if(!$user = JWTAuth::parseToken()->authenticate()){
              return response()->json(['msg'=>'Usuario no encontrado'],404);
          }
      }
      catch (\Illuminate\Validation\ValidationException $e) {
          return \response($e->errors(),422);
      }
      if (Gate::allows('solo_pacientedueno',$user )) {
          $expediente = Expediente::where('idperfil', $request->input('expediente_id'))->first();
          $enfermedad = Desease::where('id',$request->input('enfermedad_id'))->first();

          if($expediente===null){
              return response()->json("Expediente no encontrado");
          }
          if($enfermedad->nombre=='Otra'){
            $nombre=$request->input('nombre');
            $observaciones=$request->input('observaciones');

            $expediente->deseases()->attach($enfermedad->id,['nombre'=>$nombre,'observaciones'=>$observaciones]);
          }else{
            //Asocia con el expediente
            $expediente->deseases()->attach($enfermedad->id);
          }




          $response =[
              'msg'=>'Enfermedad agregada exitosamente!',
          ];
          return response()->json($response, 200);

      }else {
          $response = ['Msg'=>'No Autorizado'];
          return response()->json($response,404);
      }
  }

}

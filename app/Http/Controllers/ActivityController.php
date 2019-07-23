<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use Illuminate\Support\Facades\Gate;
use App\User;
use JWTAuth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Muestra todas las Actividades menos las eliminadas
        try {
            $actividad = Activity::orderBy('nombre', 'desc')->get();
            $response=[

                'msg' => 'Lista de Actividades',
                'Actividad' => $actividad,
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
        $actividad = new Activity(['nombre'=>$request->input('nombre')]);

        if($actividad->save()){
            $response=[
                'msg'=> 'Actividad registrada',
                'actividad'=> $actividad
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
         //Muestra la actividad especifica
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        if (Gate::allows('solo_adm',$user )) {
    $actividad = Activity::where('id', $id)->get();
    $response=[

          'Actividad' => $actividad,
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
        //actualiza actividad
        try{
            $this -> validate($request, [
                'nombre'=>'required|min:5',
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
        $actividad  = Activity::find($id);
        $actividad->nombre= $request->nombre;

        if($actividad->save()){
            $response=[
                'msg'=> 'Actividad actualizada con exito!',
                'actividad'=> $actividad
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
            if($actividad = Activity::find($id)){
        $actividad->delete();
        $response = ['Msg'=>'Actividad eliminada con exito!'];
            }else{
                $response = ['Msg'=>'Actividad no existe!'];
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


        if(Activity::onlyTrashed()->find($id)->restore()){
            $response = ['Msg'=>'Actividad restaurada con exito!'];
        }else{
            $response=['Msg' => 'Actividad no existe!'];
        }
        return response()->json($response,200);
      }else {
        $response = ['Msg'=>'No Autorizado'];
        return response()->json($response,404);
    }
    }

    //Metodo del usuario (Ramon)
    public function storeActivityxUsuario(Request $request)
    {
        try{
            $this -> validate($request, [
                'nombre'=>'required|min:5',
                'minutos'=>'required|numeric',
                'cantidad'=>'required|numeric',
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
        $actividad = new Activity([
            'nombre'=>$request->input('nombre'),
            'observaciones'=>$request->input('observaciones')
        ]);
        if($actividad->save()){
            //Asociar con expediente
            $actividad->expedientes()->attach($request->input('expediente')=== null ? [] :
            $request->input('expediente'), ['minutos'=> $request->input('minutos'),
            'cantidad'=> $request->input('cantidad')]);

            $response=[
                'msg'=> 'Actividad registrada',
                'actividad'=> $actividad
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
        //Muestra todas las Actividades eliminadas
        try {
            $actividad = Activity::onlyTrashed()->get();
            $response=[

                'msg' => 'Lista de Actividades eliminadas',
                'Actividad' => $actividad,
            ];
            return response()->json($response, 200);
        } catch (\Throwable $th) {
            return \response($th->getMessage(), 422);
        }
    }
}

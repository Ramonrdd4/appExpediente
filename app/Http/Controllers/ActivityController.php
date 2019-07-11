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




    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
            $actividad->expedientes()->attach($request->input('expediente')=== null ? [] : $request->input('expediente'), ['minutos'=> $request->input('minutos'), 'cantidad'=> $request->input('cantidad')]);

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
}

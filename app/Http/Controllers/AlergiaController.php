<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alergia;
use Illuminate\Support\Facades\Gate;
use App\User;
use JWTAuth;

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
    $alergia = Activity::all();
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        //
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

    //Metodo del usuario (Ramon)
    public function storeAlergiaxUsuario(Request $request)
    {
        try{
            $this -> validate($request, [
                'nombre'=>'required|min:5',
                'categoria'=>'required',
                'reaccion'=>'required',
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

        $alergia = new Alergia([
            'nombre'=>$request->input('nombre'),
            'categoria'=>$request->input('categoria'),
            'reaccion'=>$request->input('reaccion'),
            'observaciones'=>$request->input('observaciones')
        ]);

        if($alergia->save()){
            //Asociar con expediente
            $alergia->expedientes()->attach($request->input('expediente')=== null ? [] : $request->input('expediente'));

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
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicamento;
use Illuminate\Support\Facades\Gate;
use App\User;
use JWTAuth;
use App\Expediente;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $medicamento = Medicamento::all();
            $response=[
                'msg' => 'Lista de Medicamento',
                'Medicamentos' => $medicamento,
            ];
            return response()->json($response, 200);
        } catch(\Trowable $th) {
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
                'descripcion'=>'required',
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

        $medicamento = new Medicamento([
            'nombre'=>$request->input('nombre'),
            'descripcion'=>$request->input('descripcion')
        ]);

        if($medicamento->save()){
            //Asociar con expediente
            $medicamento = Medicamento::all();

            $response=[
                'msg'=> 'Medicamento registrado',
                'medicamento'=> $medicamento
            ];
            return response()->json($response, 201);
        }
        $response=[
            'msg'=>'Error durante el registro'
        ];
        return response()->json($response, 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           //Muestra de el medicamento especifico
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        if (Gate::allows('solo_adm',$user )) {
    $medicamento = Medicamento::where('id', $id)->get();
    $response=[

          'Medicamento' => $medicamento,
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
        //actualiza medicamento
        try{
            $this -> validate($request, [
                'nombre'=>'required|min:5',
                'descripcion'=>'required',
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

        $medicamento = Medicamento::find($id);
        $medicamento->nombre=$request->nombre;
        $medicamento->descripcion=$request->descripcion;

        if($medicamento->save()){
            //Asociar con expediente
            $medicamento = Medicamento::all();

            $response=[
                'msg'=> 'Medicamento actualizado',
                'medicamento'=> $medicamento
            ];
            return response()->json($response, 201);
        }
        $response=[
            'msg'=>'Error durante la actualización'
        ];
        return response()->json($response, 404);
    }

    public function storeMedicamentoXUsuario(Request $request)
    {
        try{
            $this -> validate($request, [
                'medicamento_id'=>'required|numeric|min:1',
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

        $medicamento = Medicamento::find($request->input('medicamento_id'));
        $expediente = Expediente::find($request->input('expediente_id'));


        if($medicamento != null and $expediente != null){
            //Asociar con expediente
            $medicamento->expedientes()->attach($request->input('expediente_id')=== null ? [] : $request->input('expediente_id'));
            $expediente = Expediente::find($request->input('expediente_id'))->with('medicamentos')->first();
            $response=[
                'msg'=> 'Medicamento registrado al expediente',
                'Expediente'=> $expediente
            ];
            return response()->json($response, 201);
        }
        $response=[
            'msg'=>'Error durante el registro'
        ];
        return response()->json($response, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\listaDesease;
use App\Desease;

class ListaDeseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $listaDesease = listaDesease::orderBy('id')->with(['deseases'])->first();
            $response=[
                'msg' => 'Lista de enfermedades más frecuentes',
                'Enfermedades' => $listaDesease
            ];
            return response()->json($response, 200);
        }
        catch(\Throwable $th){
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
        //
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
        $desease = Desease::find($request->input('desease_id'));
        if($desease->listaId == 1){
            $response =[
                'msg' => 'La enfermedad ya se encuentra en la lista.'
            ];
            return response()->json($response, 403);
        }
        $deseases = Desease::where('listaId', 1)->get();
        if(count($deseases) >= 10){
            $response =[
                'msg' => 'No puede agregar más elementos a la lista, ya esta al máximo.'
            ];
            return response()->json($response, 403);
        }

        $desease->lista()->associate($id);
        if($desease->save()){
            $listaDesease = listaDesease::orderBy('id')->with(['deseases'])->first();
            $response=[
                'msg' => 'Enfermedad agredada a la lista!',
                'Enfermedades' => $listaDesease
            ];
            return response()->json($response, 200);
        }
        $response=[
            'msg'=>'Error durante la actualización'
        ];
        return response()->json($response, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminarDeLista(Request $request,$id)
    {
        $desease = Desease::find($request->input('desease_id'));
        if($desease == null){
            return response()->json(['msg'=>'Emfermedad especificada no encontrada'], 404);
        }
        if($desease->listaId == null){
            return response()->json(['msg'=>'Emfermedad especificada no se encuntra en la lista'], 404);
        }
        $desease->listaId = null;
        if($desease->save()){
            $listaDesease = listaDesease::orderBy('id')->with(['deseases'])->first();
            $response=[
                'msg' => 'Enfermedad eliminada de la lista!',
                'Enfermedades' => $listaDesease
            ];
            return response()->json($response, 200);
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

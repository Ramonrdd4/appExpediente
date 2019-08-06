<?php

namespace App\Http\Controllers;

use App\listaAlergia;
use App\Alergia;
use Illuminate\Http\Request;

class ListaAlergiaController extends Controller
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
            //$listaAlergia = listaAlergia::orderBy('id')->with(['alergias'])->first();
            $listaAlergia = listaAlergia::orderBy('id')->withCount(['alergias'])->get();
            $response=[
                'msg' => 'Lista de Alergias más frecuentes',
                'Alergias' => $listaAlergia
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
        $alergia = Alergia::find($request->input('alergia_id'));
        if($alergia->listaId == 1){
            $response =[
                'msg' => 'La alergia ya se encuentra en la lista.'
            ];
            return response()->json($response, 403);
        }
        $alergias = Alergia::where('listaId', 1)->get();
        if(count($alergias) >= 10){
            $response =[
                'msg' => 'No puede agregar más elementos a la lista, ya esta al máximo.'
            ];
            return response()->json($response, 403);
        }

        $alergia->lista()->associate($id);
        if($alergia->save()){
            $listaAlergia = listaAlergia::orderBy('id')->with(['alergias'])->first();
            $response=[
                'msg' => 'Alergia agredada a la lista!',
                'Alergias' => $listaAlergia
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
    public function eliminarDeLista(Request $request, $id)
    {
        $alergia = Alergia::find($request->input('alergia_id'));
        if($alergia == null){
            return response()->json(['msg'=>'Alergia especificada no encontrada'], 404);
        }
        if($alergia->listaId == null){
            return response()->json(['msg'=>'Alergia especificada no se encuentra en la lista'], 404);
        }
        $alergia->listaId = null;
        if($alergia->save()){
            $listaAlergia = listaAlergia::orderBy('id')->with(['alergias'])->first();
            $response=[
                'msg' => 'Alergia eliminada de la lista!',
                'Alergias' => $listaAlergia
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

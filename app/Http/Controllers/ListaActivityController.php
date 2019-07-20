<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\listaAcitivity;
use App\Activity;

class ListaActivityController extends Controller
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
            $listaActivity = listaActivity::orderBy('id')->withCount(['activity'])->get();
            $response=[
                'msg' => 'Lista de actividades más frecuentes',
                'Alergias' => $listaActivity
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
        $activities = Activity::find($request->input('activity_id'));
        if($activities->listaId == 1){
            $response =[
                'msg' => 'La actividad ya se encuentra en la lista.'
            ];
            return response()->json($response, 403);
        }
        $activity = Activity::where('listaId', 1)->get();
        if(count($activity) >= 10){
            $response =[
                'msg' => 'No puede agregar más elementos a la lista, ya esta al máximo.'
            ];
            return response()->json($response, 403);
        }

        $activity->lista()->associate($id);
        if($activity->save()){
            $listaActivity = listaActivity::orderBy('id')->with(['activities'])->first();
            $response=[
                'msg' => 'Actividad agredada a la lista!',
                'Actividades' => $listaActivity
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
        $activity = Activity::find($request->input('activity_id'));
        if($activity == null){
            return response()->json(['msg'=>'Actividad especificada no encontrada'], 404);
        }
        $activity->listaId = null;
        if($activity->save()){
            $listaActivity = listaAcitivity::orderBy('id')->with(['activities'])->first();
            $response=[
                'msg' => 'Alergia eliminada de la lista!',
                'Actividades' => $listaActivity
            ];
            return response()->json($response, 200);
        }
    }
}

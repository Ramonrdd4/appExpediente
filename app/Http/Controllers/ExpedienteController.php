<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Expediente;
use App\Fumado;
use App\Alcohol;
use JWTAuth;


class ExpedienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      //Crea el expediente asociado
      try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        $this->validate($request, [
                'id'=>'required|min:9',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e ) {
        return \response($e->errors(),422);
    }
    if (Gate::allows('solo_pacientedueno',$user )) {
    $expediente = new Expediente();
    $expediente->id = $request->input('id');
    $expediente->tieneAlergia = false;
    $expediente->tieneEnfermedadF = false;
    $expediente->tieneActividad = false;

    $fumado = Fumado::find($request->input('id'));
    if($fumado == null){
        return response()->json(['msg'=>'Aun no cuenta con registro de fumado'], 404);
    }
    $expediente->fumado()->associate($request->input('id'));

    $alcohol = Fumado::find($request->input(id));
    if($alcohol == null){
        return response()->json(['msg'=>'Aun no cuenta con registro de alocholismo'], 404);
    }
    $expediente->alcohol()->associate($request->input('id'));


    if( $expediente->save()){
              //expediente con características
        $expediente = $expediente->where('id',$expediente->id)->first();
        $response=[
            'msg'=>'Información del expediente',
            'Expediente'=>$expediente
        ];
        return response()->json(['expediente' => $expediente]);
    }else{
        $response = ['Msg'=>'Error al registrar el expediente, por favor intentelo de nuevo'];
        return response()->json($response,404);
    }

}else {
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
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }
            if (Gate::allows('solo_pacientedueno',$user )){

                $expediente = Expediente::where('id', $id)->with('fumado', 'alcohol')->get();
                $response = [
                    'msg' => 'Detalle de expediente',
                    'Expediente' => $expediente
                ];
                return response()->json($response, 200);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
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
        //
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

    public function listarAlergiasXPaciente($id){
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }
            if (Gate::allows('solo_pacientedueno',$user )){

                $expediente = Expediente::where('id', $id)->with('alergias')->get();
                $response = [
                    'msg' => 'Detalle de expediente',
                    'Expediente' => $expediente
                ];
                return response()->json($response, 200);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
    }

    public function listarEnfermedadesXPaciente($id){
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }
            if (Gate::allows('solo_pacientedueno',$user )){

                $expediente = Expediente::where('id', $id)->with('deseases')->get();
                $response = [
                    'msg' => 'Detalle de expediente',
                    'Expediente' => $expediente
                ];
                return response()->json($response, 200);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
    }

    public function listarMedicamentosXPaciente($id){
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }
            if (Gate::allows('solo_pacientedueno',$user )){

                $expediente = Expediente::where('id', $id)->with('medicamentos')->get();
                $response = [
                    'msg' => 'Detalle de expediente',
                    'Expediente' => $expediente
                ];
                return response()->json($response, 200);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
    }

    public function listarActividadesXPaciente($id){
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }
            if (Gate::allows('solo_pacientedueno',$user )){

                $expediente = Expediente::where('id', $id)->with('activities')->get();
                $response = [
                    'msg' => 'Detalle de expediente',
                    'Expediente' => $expediente
                ];
                return response()->json($response, 200);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
    }
}

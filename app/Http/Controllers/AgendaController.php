<?php

namespace App\Http\Controllers;

use App\Agenda;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Gate;
use App\Horario;
use App\Profile;

class AgendaController extends Controller
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
        //Agrega una agenda
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg'=>'Usuario no encontrado'], 404);
            }
            $this->validate($request, [
                    'id_Horario' => 'required',
                    'id_perfil' => 'required|min:9',
            ]);



        } catch (\Illuminate\Validation\ValidationException $e ) {
            return \response($e->errors(),422);
        }
        if (Gate::allows('solo_pacientedueno',$user )) {


            $Agenda = new Agenda();
            $Agenda->estado_cita = true;
            $horario = Horario::where('id', $request->id_Horario)->first();
            $horario->estado = false;
            $Agenda->Horario()->associate($request->id_Horario);
            $Agenda->Profile()->associate($request->id_perfil);

            $Agenda->save();
            $horario->update();

            $AgendaSave= $Agenda->get();
            $response = [
                'msg' => 'Cita registrada',
                'citas' => $AgendaSave
            ];
            return response()->json($response, 200);
    }else {
        $response = ['Msg'=>'No Autorizado'];
        return response()->json($response,404);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        //
    }
    public function detalleAgendaMedico($id)
    {
        try {
            if (!$usuario = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->responseErrors($e->errors(), 422);
        }

        if (Gate::allows('solo_medico', $usuario)) {


            $agendas = Horario::where('id', $id)->with([
                'servicio__consultas.especialidad', 'servicio__consultas.user',
                'Agenda.perfil'
            ])->first();


            $response = [
                'msg' => 'Lista de Agendas',
                'horarios' => [$agendas]
            ];
            return response()->json($response, 200);
        }

        $response = [
            'msg' => 'No autorizado'
        ];
        return response()->json($response, 422);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        //
    }



    public function AgendaPaciente($id)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg'=>'Usuario no encontrado'], 404);
            }

            $perfil = Profile::where('idUsuario', $user->id)->get();
            $agendas = collect();
            foreach ($perfil as $per) {
                $agenda = Agenda::where('id_perfil', $per->id)->with('Horario','Profile','Horario.servicio__consultas')->get();
                $agendas->push($agenda);
            }


            $response = [
                'msg' => 'Lista de horarios',
                'citas' => $agendas
            ];
            return response()->json($response, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->responseErrors($e->errors(), 422);
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

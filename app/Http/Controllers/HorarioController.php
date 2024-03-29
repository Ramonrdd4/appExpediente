<?php

namespace App\Http\Controllers;

use App\Horario;
use App\servicio__consultas;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Tymon\JWTAuth\Exceptions\JWTException;



class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //muestra los horarios por servicio
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
         return response()->json(['msg'=>'Usuario no encontrado'], 404);
     }

    $horario= Horario::where('estado',1)->with('servicio__consultas')->get();
    $response=[
     'msg' => 'Lista de horarios',
     'horarios' => $horario,
    ];
        return response()->json($response, 200);

     } catch (\Throwable $th) {
       return $this->responseErrors($e->errors(), 422);
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
        //Crear hOrario de consulta doctor
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg'=>'Usuario no encontrado'], 404);
            }
            $this->validate($request, [
                    'Fecha_cita' => 'required|date',
                    'hora_cita' => 'required',
                    'id_servicioConsulta' => 'required|min:1',
            ]);



        } catch (\Illuminate\Validation\ValidationException $e ) {
            return $this->responseErrors($e->errors(), 422);
        }
        if (Gate::allows('solo_medico',$user )) {
        $carbon= Carbon::now();
        $carbon = $carbon->format('Y-m-d');
        $fecha = $request->Fecha_cita;
        $hora =  $request->hora_cita;
        $usuario = $user;
        if($fecha>$carbon){
            if($this->validarFecha($usuario,$fecha,$hora)){
                $horario = new Horario();
                $horario->Fecha_cita = $request->Fecha_cita;
                $horario->hora_cita = $request->hora_cita;
                $horario->estado = true;
                $horario->servicio__consultas()->associate($request->id_servicioConsulta);
                $horario->save();

                $HorarioSave=$horario->with('servicio__consultas')->get();

                return response()->json(['servicio__consultas' => $HorarioSave]);
            }else{
                $response = ['Msg'=>'Tiene que haber 30 minutos entre consultas como minimo.'];
                return  $this->responseErrors()->json($response,404);
            }

        }else{
            $response = ['Msg'=>'La fecha es menor o igual que la actual'];
               return $this->responseErrors()->json($response,404);
        }
    }else {
        $response = ['Msg'=>'No Autorizado'];
        return response()->json($response,404);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //muestra los horarios por servicio
    try {
           if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }

    $horario= Horario::where('id_servicioConsulta',$id)->get();
       $response=[
        'msg' => 'Lista de horarios',
        'horarios' => $horario,
    ];
   return response()->json($response, 200);

        } catch (\Throwable $th) {
          return $this->responseErrors($e->errors(), 422);
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function edit(Horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Horario $horario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Horario  $horario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        if (Gate::allows('solo_medico',$user )) {


        if( $horario = Horario::find($id)){
            $horario->delete();
            $response = ['Msg'=>'Horario eliminado con exito!'];
        }else{
            $response=['Msg' => 'Horario no existe!'];
        }
        return response()->json($response,200);
      }else {
        $response = ['Msg'=>'No Autorizado'];
        return response()->json($response,404);
    }
    }
    private static function validarFecha($usuario, $fechaRequest, $horaRequest){
        $fecha = new Carbon($fechaRequest);
        $hora = new Carbon($horaRequest);

        $servicio = servicio__consultas::where('id_Doctor',$usuario->id)->get();
        foreach($servicio as $servicios)
        {
            $horarios = Horario::where('id_servicioConsulta', $servicios->id)->get();

            //Valida que no hayan citas en el mismo horario
            foreach ($horarios as $horario)
            {
                $fechaAsignada = new Carbon($horario->fechaCita);
                $fechaAsignada = $fechaAsignada->format('Y-m-d');
                $horaAsignada = new Carbon($horario->hora_cita);

                    if ($fecha===$fechaAsignada) {

                        $diferenciaMinutos = $hora->gt($horaAsignada)?
                        $horaAsignada->diffInMinutes($hora) : $hora->diffInMinutes($horaAsignada);

                        if($diferenciaMinutos < 30){
                            return false;

                        }
                    }


            }
        }
        return true;
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
    public function HorariosMedico($id)
    {
        try {
            if (!$usuario = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }

            $serv_consulta = servicio__consultas::where('id_doctor', $id)->get();
            $horarios = collect();
            foreach ($serv_consulta as $serv) {
                foreach ($serv->horarios()->withoutTrashed()->with('servicio__consultas.especialidad','Agenda.Profile')
             ->get() as $hora) {
                    $horarios->push($hora);
                }
            }
            $response = [
                'msg' => 'Lista de horarios',
                'horarios' => $horarios
            ];
            return response()->json($response, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->responseErrors($e->errors(), 422);
        }
    }
    public function HorarioMedico($id)
    {
        try {
            if (!$usuario = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }
            $primerDia = now();
            $ultimoDia = now()->endOfWeek();
            $uno = new Carbon($primerDia);
            $dos = new Carbon($ultimoDia);
            $uno = $uno->format('Y-m-d');
            $dos = $dos->format('Y-m-d');

                $horario = Horario::where('id_servicioConsulta', $id)
                ->where('estado', 1)->whereBetween('Fecha_cita', [$uno, $dos])
                ->with('servicio__consultas.especialidad','servicio__consultas.user')
                ->get();



            $response = [
                'msg' => 'Lista de horarios',
                'horarios' => $horario
            ];
            return response()->json($response, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->responseErrors($e->errors(), 422);
        }
    }

}

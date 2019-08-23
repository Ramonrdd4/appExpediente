<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Expediente;
use JWTAuth;
use Illuminate\Support\Facades\Storage;

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
    public function showActividad($id, $idexp)
    {
         //Muestra la actividad especifica
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        if (Gate::allows('solo_adm',$user )||Gate::allows('solo_pacientedueno',$user )) {
    $expediente = Expediente::find($idexp);
    $actividad = $expediente->activities()->where('activity_id', $id)->first();
    $response=[
          'msg' => 'Registro de Actividad',
          'Actividad' => [$actividad]
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
                'activity_id'=>'required|numeric',
                'minutos'=>'required|numeric',
                'cantidad'=>'required|numeric',
            ]);
            //Obtener el usuario autentificado actual
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }

        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        if (Gate::allows('solo_adm',$user )||Gate::allows('solo_pacientedueno',$user )) {
        $actividad_id  = $request->input('activity_id');
        $exp = Expediente::find($id);
        $exp->activities()->updateExistingPivot($actividad_id, ['cantidad'=>$request->input('cantidad'), 'minutos'=>$request->input('minutos')]);


        if($exp->save()){
            $exp = Expediente::where('id', 116850044)->with('activities')->get();
            $response=[
                'msg'=> 'Actividad actualizada con exito!',
                'actividad'=> $exp
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


    public function storeActivityxUsuario(Request $request, $id)
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
        $actividad = new Activity([
            'nombre'=>$request->input('nombre'),
        ]);
        if($actividad->save()){
            //Asociar con expediente
            $idactividad = $actividad->id;
            $expediente = Expediente::find($id);
            $expediente->activities()->attach($idactividad, ['minutos' => 15, 'cantidad' => 1]);
            $expediente = Expediente::where('id', $id)->with('alergias')->get();

            $response=[
                'msg'=> 'Actividad registrada',
                'Actividad'=> $actividad
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
      //Metodo del usuario (Fabiola)
      public function storeActividadxUsuario(Request $request)
      {
        try{
            $this -> validate($request, [
                'nombre' => 'required',
                'minutos'=>'required|numeric',
                'cantidad'=>'required|numeric',

            ]);
            //Obtener el usuario autentificado actual
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['msg'=>'Usuario no encontrado'],404);
            }
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(),422);
        }
        if (Gate::allows('solo_pacientedueno',$user )) {
            $expediente = Expediente::where('id', $request->input('expediente_id'))->first();
            $actividad = Activity::where('id', $request->input('actividad_id'))->first();
            $minutos=$request->input('minutos');
            $cantidad=$request->input('cantidad');




            if($expediente===null){
                return response()->json("Expediente no encontrado");
            }
            //Asocia con el expediente
            if($actividad->nombre=='Otra'){
                $nombre=$request->input('nombre');
                $expediente->activities()->attach($actividad->id,['minutos'=>$minutos,'cantidad'=>$cantidad,'nombre'=>$nombre]);
            }else{
                $expediente->activities()->attach($actividad->id,['minutos'=>$minutos,'cantidad'=>$cantidad]);
            }


            $response =[
                'msg'=>'Actividad agregada exitosamente!',
            ];
            return response()->json($response, 200);

        }else {
            $response = ['Msg'=>'No Autorizado'];
            return response()->json($response,404);
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
    public function storeImagen($id, Request $request)
    {
        try {
            $this->validate($request, [
                'imagen' => 'required|image|mimes:jpeg,png,jpg,gif'
            ]);
            if (!$usuario = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }
            $actividad = Activity::where('id', $id)->firstOrFail();
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->responseErrors($e->errors(), 422);
        }
        if ($request->has('imagen')) {

            // Obtiene el archivo imagen
            $image = $request->file('imagen');

            // Crea un nombre customizado para la imagen a guardar
            //En este caso se usara el patrón de nombre_usuario + time()
            $nombreCompleto = $usuario->nombre . '_actividad';
            $name = $nombreCompleto . '_' . time();

            // Se define la ruta del folder donde se guardarán las imagenes
            $folder = '/subida/imagenes/actividad/';

            $file_name = $name . '.' . $image->getClientOriginalExtension();
            // Se crea la ruta del archivo donde se almacenará la imagen
            $filePath = $folder . $file_name;

            $image->storeAs($folder, $name.'.'.$image->getClientOriginalExtension(), 'public');

            // Se le añade la ruta al Videojuego para insertarse en la base de datos
            $actividad->ruta_imagen = $file_name;
            if ($actividad->save()) {
                $response = [
                    'msg' => 'Imagen Guardada!',
                    'actividad' => $actividad
                ];
                return response()->json($response, 201);
            } else {
                $response = [
                    'msg' => 'Error durante la creación'
                ];
                return response()->json($response, 400);
            }
        }
    }
    public function ObtenerImagen($filename)
    {
        $archivo = Storage::get('public/subida/imagenes/actividad/'.$filename);
        if($archivo != null){
            $mime = Storage::mimeType(('public/subida/imagenes/actividad/'.$filename));

            return response($archivo,200)->header('Content-Type', $mime);
        }else{
            $response = [
                'msg' => 'Imagen no encontrada'
            ];
            return response()->json($response, 404);

        }


    }
    }


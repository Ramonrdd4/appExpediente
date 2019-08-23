<?php

namespace App\Http\Controllers;

use App\Compartir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Expediente;
use JWTAuth;

class CompartirController extends Controller
{





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function expedientesCompartidosUuario()
    {
        try {
            if (!$usuario = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }

            $compartidos = Compartir::where('user_id', $usuario->id)
                ->with([
                    'user', 'expediente.profile'
                ])->get();

            $response = [
                'msg' => 'Expedientes compartidos',
                'compartidos' => $compartidos
            ];
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return \response($e->getMessage(), 422);
        }
    }

    public function usuariosCompartidoExpediente($id)
    {
        try {
            if (!$usuario = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }

            if (Gate::allows('solo_pacientedueno', $usuario)) {
                $expediente = Expediente::where('id', $id)->firstOrFail();

                $compartidos = Compartir::where('expediente_id', $expediente->id)
                    ->with([
                        'user'
                    ])->get();

                $response = [
                    'msg' => 'Usuarios con los que se ha compartido el expediente',
                    'compartidos' => $compartidos
                ];
                return response()->json($response, 200);
            }
            $response = [
                'msg' => 'No autorizado'
            ];
            return response()->json($response, 404);
        } catch (\Exception $e) {
            return \response($e->getMessage(), 422);
        }
    }
    public function compartir_expediente(Request $request)
    {
        try {
            $this->validate($request, [
                'user_id' => 'required|numeric',
                'perfil_id' => 'required|numeric'
            ]);
            if (!$usuario = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }

            $expediente = Expediente::where('id', $request->input("perfil_id"))
                ->with('profile')->firstOrFail();
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->responseErrors($e->errors(), 422);
        }

        if (Gate::allows('solo_pacientedueno', $usuario)) {

            $compartir = new Compartir();
            $compartir->user_id = $request->input("user_id");

            if ($expediente->compartirs()->save($compartir)) {
                $compartir_response = Compartir::where('id', $compartir->id)
                    ->with(['user', 'expediente'])
                    ->first();

                $response = [
                    'msg' => 'Expediente compartido!',
                    'compartidos' => [$compartir_response]
                ];
                return response()->json($response, 201);
            }
        }

        $response = [
            'msg' => 'No autorizado'
        ];
        return response()->json($response, 404);
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
     * @param  \App\Compartir  $compartir
     * @return \Illuminate\Http\Response
     */
    public function show(Compartir $compartir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compartir  $compartir
     * @return \Illuminate\Http\Response
     */
    public function edit(Compartir $compartir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compartir  $compartir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compartir $compartir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compartir  $compartir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compartir $compartir)
    {
        //
    }
}

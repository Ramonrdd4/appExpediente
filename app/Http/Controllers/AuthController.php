<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth',['except' => ['login','register']]);

    }
    protected function guard(){
        return Auth::guard('api');
    }

    //Este es el registar normal de la pagina principal
    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'correo' => 'required|email',
                'nombre' => 'required|min:5',
                'primerApellido' => 'required|min:6',
                'segundoApellido' => 'required|min:6',
                'sexo' => 'required|min:1',
                'contrasenna' => 'required|min:6'

            ]);
        } catch (\Illuminate\Validation\ValidationException $e ) {
            return \response($e->errors(),422);
        }

        $user = new User();

        $user->correo = $request->correo;
        $user->nombre = $request->nombre;
        $user->primerApellido = $request->primerApellido;
        $user->segundoApellido = $request->segundoApellido;
        $user->sexo = $request->sexo;
        $user->contrasenna = bcrypt($request->contrasenna);

        //Asociar con roll
        $user->rol()->associate(3);

        $user->save();
        return response()->json(['user' => $user]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('correo', 'contrasenna');

        if (! $token = $this->guard()->attempt($credentials)) {
            return response()->json(['error' => 'No Autorizado'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user'=>$this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }


     //Este es el registar un medico el admi
     public function registerAdm(Request $request)
     {
         try {
             $this->validate($request, [
                 'correo' => 'required|email',
                 'nombre' => 'required|min:5',
                 'primerApellido' => 'required|min:6',
                 'segundoApellido' => 'required|min:6',
                 'sexo' => 'required|min:1',
                 'contrasenna' => 'required|min:6'

             ]);
         } catch (\Illuminate\Validation\ValidationException $e ) {
             return \response($e->errors(),422);
         }
         if (!$user = JWTAuth::parseToken()->authenticate()&& !$user.rol_id==1) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
         }

         $user = new User();

         $user->correo = $request->correo;
         $user->nombre = $request->nombre;
         $user->primerApellido = $request->primerApellido;
         $user->segundoApellido = $request->segundoApellido;
         $user->sexo = $request->sexo;
         $user->contrasenna = bcrypt($request->contrasenna);

         //Asociar con roll
         $user->rol()->associate(2);

         $user->save();
         return response()->json(['user' => $user]);


     }


}

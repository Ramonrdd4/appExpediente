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
        // ahi donde dice login se agregan todas las acciones en las que no ocupan las credenciales y agregamos register
        $this->middleware('jwt.auth', ['except' => ['register','login']]);
    }

    protected function guard(){
        return Auth::guard('api');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        //attempt autentifica con las credenciales si realmente existe este usuario

        if (!$token = $this->guard()->attempt($credentials)) {
            return response()->json(['error' => 'No Autorizado'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token).
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
//registar normal
    public function register(Request $request)
{
    try {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email',
                'nombre' => 'required|min:5',
                'primerApellido' => 'required|min:6',
                'segundoApellido' => 'required|min:6',
                'sexo' => 'required|min:1',
                'password' => 'required|min:6'
        ]);
    } catch (\Illuminate\Validation\ValidationException $e ) {
        return $this->responseErrors($e->errors(), 422);
    }

    $user1 = new User();
    $user1->email = $request->email;
    $user1->nombre = $request->nombre;
    $user1->primerApellido = $request->primerApellido;
    $user1->segundoApellido = $request->segundoApellido;
    $user1->sexo = $request->sexo;
    $user1->password = bcrypt($request->password);


        $user1->rol()->associate(3);

    $user1->save();
    return response()->json(['user' => $user1]);
}
public function update(Request $request)
{
    //se modifica el Administrador
    try {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['msg'=>'Usuario no encontrado'], 404);
        }
        $this->validate($request, [
                'nombre' => 'required|min:5',
                'primerApellido' => 'required|min:6',
                'segundoApellido' => 'required|min:6',
                'sexo' => 'required|min:1',
                'password' => 'required|min:6'
        ]);



    } catch (\Illuminate\Validation\ValidationException $e ) {
          return $this->responseErrors($e->errors(), 422);
    }

    $user1 = User::find($user->id);
    $user1->nombre = $request->nombre;
    $user1->primerApellido = $request->primerApellido;
    $user1->segundoApellido = $request->segundoApellido;
    $user1->sexo = $request->sexo;
    $user1->password = bcrypt($request->password);
    $user1->save();
    return response()->json(['user' => $user1]);
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

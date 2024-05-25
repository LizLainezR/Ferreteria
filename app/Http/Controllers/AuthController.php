<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistroRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  /* public function login(LoginRequest  $request){  
       $credentials = $request->only('username', 'password');
       $rememberMeValue = $request->boolean('remember_me');
       $existeCredenciales=Auth::attempt($credentials, $rememberMeValue);
     if (Auth::attempt($credentials)) {
            $user = $request->user();
            $roleName = $user->rol->role_name;             
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            return response()->json( [
                'jwt' => $token,
               //    'menus' => $menus,
                'remembe_me' => $rememberMeValue,
                'users' => $user
            ]);
  } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('username', 'password');
            $rememberMeValue = $request->boolean('remember_me');
        
            // Intenta autenticar al usuario
            if (Auth::attempt($credentials, $rememberMeValue)) {
                $user = Auth::user();
                $roleName = $user->rol->role_name;
                $token = $this->validateToken($user, 'AppName', $roleName);
        
                // Devuelve una respuesta exitosa
                return response()->json([
                    'jwt' => $token,
                    'token'=>$token,
                    'remember_me' => $rememberMeValue,
                    'user' => $user
                ]);
            } else {
                // Si las credenciales son incorrectas, lanzar una excepción de validación
                throw ValidationException::withMessages([
                     ['Credenciales incorrectas.'],
                ]);
            }
        } catch (ValidationException $e) {
            // Manejar la excepción de validación
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            // Manejar otras excepciones, como errores de base de datos u otros
            return response()->json(['message' => 'Error de autenticación.'], 500);
        }
    }
    public function validateToken($user, $appName, $roleName){
    // Obtener el token de acceso actual
    $existingToken = $user->currentAccessToken();
    // Si el token existe y no ha expirado, devolverlo
    if ($existingToken && !$existingToken->isExpired()) {
        return $existingToken->plainTextToken;
    }    
    // Crear un nuevo token y devolverlo
    return $user->createToken($appName, [$roleName], now()->addWeek())->plainTextToken;
}


    public function register(RegistroRequest $request){
        $data =  $request->validated();
        $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']) ,
                'id_role' => $data['id_role'],  
              ]);
            
            return [
                'token'=> $user->createToken('token')->plainTextToken,
                'users'=>$user
            ];
    }
  

}

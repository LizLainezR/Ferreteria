<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegistroRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller{
    public function login(LoginRequest $request){
        try {
            
            $credentials = $request->only('username', 'password');  
            $rememberMeValue = $request->boolean('remember_me');         
            if (Auth::attempt($credentials, $rememberMeValue)) {
                $user = Auth::user();
                $roleName = $user->rol->role_name;
                $token = $this->validateToken($user, 'AppName', $roleName);                
                return response()->json([
                    'jwt' => $token, 
                    'remember_me' => $rememberMeValue,
                    'user' => $user ]);
            } else {
                throw ValidationException::withMessages([
                     ['Credenciales incorrectas.'],
                ]);
            }
        } catch (ValidationException $e) {
             return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error de autenticación.'], 500);
        }
    }
    public function validateToken($user, $appName, $roleName){
        $existingToken = $user->currentAccessToken();
        if ($existingToken && !$existingToken->isExpired()) {
        return $existingToken->plainTextToken;
    }    
  
    return $user->createToken($appName, [$roleName], now()->addWeek())->plainTextToken;
}



public function storeUser(RegistroRequest $request)
{  
    try {
        $data = $request->validated();
        $user = User::create([
            'code'=>$data['code'],
            'cedula'=>$data['cedula'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'id_role' => $data['id_role'],
        ]);
      
        $token = $user->createToken('AppName')->plainTextToken;
      
        return response()->json([
            'token' => $token,
            'user' => $user
        ], 201
    );
    } catch (ValidationException $e) {
        return response()->json(['errors' => $e->errors()], 422);
    } catch (\Exception $e) {
            return response()->json(['message' => 'Error al procesar la solicitud.'], 403);
        }
    }

    public function getActiveUsers(){
        $activeUsers = User::active()->get();
        return response()->json($activeUsers);
    }

   public function update(User $user, RegistroRequest $request)
{
    try {
        $data = $request->validated();
        $userData = [
            'username' => $data['username'],
            'email' => $data['email'],
            'id_role' => $data['id_role'],
        ];
        if (isset($data['password'])) {
            $userData['password'] = bcrypt($data['password']);
        }
        $user->update($userData);
        return response()->json(['message' => 'Usuario actualizado exitosamente']);
    
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al actualizar el usuario.'], 500);
    }
}

}

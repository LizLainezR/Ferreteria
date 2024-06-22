<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class RolController extends Controller
{
    // Método para mostrar todos los roles
  public function indexRole()
  {
      $roles = Rol::all();
      return response()->json($roles);
  }

  // Método para mostrar un rol específico
  public function show(Rol $role){
    if (!$role->status) {
        return response()->json(['message' => 'El rol ha sido eliminado'], 404);
    }
    return response()->json($role);
}
  public function storeRole(RoleRequest $request)
  {   
    try {    
        $data = $request->validated();
        $rol = Rol::create([
            'role_name' => $data['role_name'],
            'status' => $data['status'],
        ]);
        return response()->json(['role' => $rol], 201);
    } catch (ValidationException $e) {
        return response()->json(['errors' => $e->errors()], 422);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Ocurrió un error inesperado'], 500);
    }} 
    
    public function update(Request $request, $id){
      $request->validate([
          'role_name' => 'required|string|unique:role',
      ]);

      $rol = Rol::findOrFail($id);
      $rol->update($request->all());
      return response()->json($rol, 200);
  }
  
  public function deactivate($id){
      $rol = Rol::findOrFail($id);
      $rol->activo = false; // Suponiendo que tienes un campo 'activo' en tu tabla de roles
      $rol->save();
      return response()->json($rol, 200);
  }



}

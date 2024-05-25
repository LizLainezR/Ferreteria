<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    // Método para mostrar todos los roles
  public function index()
  {
      $roles = Rol::all();
      return response()->json($roles);
  }

  // Método para mostrar un rol específico
  public function show($id)
  {
      $rol = Rol::findOrFail($id);
      return response()->json($rol);
  }

  // Método para crear un nuevo rol
  public function store(Request $request){
    $request->validate(['role_name' => 'required|string', ]);
    $existingRol = Rol::where('role_name', $request->role_name)->first();
       if ($existingRol) {
          return response()->json(['message' => 'El rol ya existe'], 409);
         }
     $rol = Rol::create(['role_name' => $request->role_name,]);
       return response()->json($rol, 201);
  }

  // Método para actualizar un rol existente
  public function update(Request $request, $id)
  {
      $request->validate([
          'role_name' => 'required|string|unique:rol',
      ]);

      $rol = Rol::findOrFail($id);
      $rol->update($request->all());
      return response()->json($rol, 200);
  }

  // Método para desactivar un rol
  public function deactivate($id)
  {
      $rol = Rol::findOrFail($id);
      $rol->activo = false; // Suponiendo que tienes un campo 'activo' en tu tabla de roles
      $rol->save();
      return response()->json($rol, 200);
  }



}

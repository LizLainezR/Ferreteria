<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rol extends Model
{
    use HasFactory;
    
    protected $table = 'role'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'id_role'; // Clave primaria de la tabla

    protected $fillable = [
        'role_name',
    ];

    // Relación con el modelo Usuario
    public function user(){
        Log::info('Dentro del método user() en el modelo Rol');
        dd('Dentro del método user() en el modelo Rol');
        return $this->hasMany(User::class, 'id_role', 'id_role');
    }
 
  
}

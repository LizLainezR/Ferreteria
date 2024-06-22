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
        'status'
    ];
    protected function casts(): array
    {
        return [
            'status' => 'boolean'
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    // Relación con el modelo Usuario
    public function user(){
        return $this->hasMany(User::class, 'id_role','id_role');    
    }
    public function permission(){
        return $this->hasMany(Permission::class, 'id_role','id_role');    
    }

  
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;


    protected $table = 'module'; 

    protected $primaryKey = 'id_module'; 

    protected $fillable = [
        'description',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    public function submodulos(){
        return $this->hasMany(Submodule::class, 'id_module', 'id_module');
    }
 
}

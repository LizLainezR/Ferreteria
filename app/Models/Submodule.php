<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submodule extends Model
{
    use HasFactory;
    protected $table = 'submodule'; 

    protected $primaryKey = 'id_submodule'; 

    protected $fillable = [
        'description',
        'id_module',
        'status'
    ];
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function module()
    { return $this->belongsTo(Module::class, 'id_module');}

    public function permission(){
        return $this->hasMany(Permission::class, 'id_submodule','id_submodule');    
    }

    
}

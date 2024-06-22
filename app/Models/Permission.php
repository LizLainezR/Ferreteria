<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permissions';

    protected $primaryKey = 'id_per';

    protected $fillable = [
        'id_per',
        'description',
        'id_role',
        'id_submodule',
    ];

    public function submodule()
    {   return $this->belongsTo(Submodule::class, 'id_submodule');
    }
    public function rol()
    {   
        return $this->belongsTo(Rol::class, 'id_role');}
}

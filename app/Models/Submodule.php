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
        'id_module'
    ];


    public function module()
    { return $this->belongsTo(Module::class, 'id_module');}


    
}

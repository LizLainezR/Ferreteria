<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pattern';

    protected $fillable = [
        'models_name',
        'id_trademark',
        'status',
    ];

    // Relación inversa con Trademark
    public function trademark()
    {
        return $this->belongsTo(Trademark::class, 'id_trademark');
    }

    // Relación uno a muchos con Product
    public function products()
    {
        return $this->hasMany(Product::class, 'id_pattern');
    }
}

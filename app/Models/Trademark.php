<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_trademark';

    protected $fillable = [
        'trademark_name',
        'status',
    ];

    // Relación uno a muchos con Pattern
    public function patterns()
    {
        return $this->hasMany(Pattern::class, 'id_trademark');
    }
}

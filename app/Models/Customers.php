<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_unique_ced';
    public $incrementing = false; // Esto es necesario para las claves primarias no incrementales

    protected $fillable = [
        'id_unique_ced',
        'full_name',
        'address',
        'cell_phone',
        'email',
        'id_types',
        'observations',
    ];

    // Relación inversa con CustomerType
    public function customerType()
    {
        return $this->belongsTo(Customer_types::class, 'id_types');
    }
}

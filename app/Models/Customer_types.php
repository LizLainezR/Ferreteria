<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_types extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_types';

    protected $fillable = [
        'name',
    ];

    // Relación uno a muchos con Customer
    public function customers()
    {
        return $this->hasMany(Customers::class, 'id_types');
    }
}

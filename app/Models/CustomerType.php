<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    use HasFactory;
    protected $table = 'customer_types'; 
    protected $primaryKey = 'idcustomer_types';

    protected $fillable = [
        'name',
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
    // Relación uno a muchos con Customer
    public function customers()
    {
        return $this->hasMany(Customers::class, 'idcustomer_types','idcustomer_types');
    }
}

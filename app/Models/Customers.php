<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    
    protected $table = 'customers'; 
    protected $primaryKey = 'id_unique';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_unique',
        'full_name',
        'business_name',
        'city',
        'address',
        'cell_phone',
        'whatsapp',
        'email',
        'idcustomer_types',
        'observations',
        'status',
    ];
    protected function casts(): array
    {
        return [
            'status' => 'boolean'
        ];
    }
    protected static function boot()
    {
        parent::boot();

        // Configurar el campo 'status' automáticamente
        static::creating(function ($customer) {
            $customer->status = true;
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    // Relación inversa con CustomerType
    public function customerType()
    {
        return $this->belongsTo(CustomerType::class, 'idcustomer_types');
    }
}

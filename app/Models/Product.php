<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'id_product'; // Clave primaria de la tabla

    // Los campos de la tabla que se pueden llenar de forma masiva
    protected $fillable = [
        'sku',
        'product_name',
        'description',
        'img',
        'unit_price',
        'stock_quantity',
        'stock_max',
        'stock_min',
        'status',
        'category_id',
        'pattern_id',
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
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relación inversa con Pattern
    public function pattern()
    {
        return $this->belongsTo(Pattern::class, 'pattern_id');
    }
}

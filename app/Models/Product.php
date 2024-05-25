<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_product';

    protected $fillable = [
        'product_name',
        'description',
        'img',
        'cost',
        'stock_quantity',
        'stock_max',
        'stock_min',
        'status',
        'id_category',
        'id_pattern',
    ];

    // Relación inversa con Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    // Relación inversa con Pattern
    public function pattern()
    {
        return $this->belongsTo(Pattern::class, 'id_pattern');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_details extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'amount',
        'subtotal',
        'unit_price',
        'status',
        'header_id',
        'id_product',
    ];

    // Relación inversa con SaleHeader
    public function saleHeader()
    {
        return $this->belongsTo(Sale_Header::class, 'header_id');
    }

    // Relación inversa con Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}

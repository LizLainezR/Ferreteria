<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_details extends Model
{
    use HasFactory;
    
    protected $table = 'sale_details';
    protected $primaryKey = 'id_detail';

    use HasFactory;

    protected $fillable = [
    'amount', 
    'subtotal', 
    'unit_price', 
    'status', 
    'header_id', 
    'id_product'];
    public function salesHeader()
    {
        return $this->belongsTo(Sale_Header::class, 'header_id', 'header_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
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
        static::creating(function ($sale_det) {
            $sale_det->status = true;
        });
    }

}

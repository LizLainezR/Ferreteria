<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_header extends Model
{
    use HasFactory;
    protected $primaryKey = 'header_id';

    protected $fillable = [
        'total_sale',
        'discount',
        'Iva',
        'id_unique_ced',
        'payment_id',
    ];

    // Relación inversa con Payment
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    // Relación inversa con Customer
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'id_unique_ced', 'id_unique_ced');
    }

    // Relación uno a muchos con SaleDetail
    public function saleDetails()
    {
        return $this->hasMany(Sale_details::class, 'header_id');
    }
}
